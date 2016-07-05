<?php


namespace Mouf\Hydrator;


use Stringy\StaticStringy;

class TdbmHydrator implements Hydrator
{

    /**
     * Creates a new $className object, filling it with $data.
     *
     * @param array $data
     * @param string $className
     * @return object
     */
    public function hydrateNewObject(array $data, string $className)
    {
        $reflectionClass = new \ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();
        $constructorParameters = $constructor->getParameters();

        $underscoredData = [];
        foreach ($data as $key => $value) {
            $underscoredData[(string) StaticStringy::underscored($key)] = $value;
        }

        $parameters = [];

        foreach ($constructorParameters as $constructorParameter) {
            $underscoredVariableName = (string) StaticStringy::underscored($constructorParameter->getName());

            if (array_key_exists($underscoredVariableName, $underscoredData)) {
                $value = $underscoredData[$underscoredVariableName];
                unset($underscoredData[$underscoredVariableName]);
            } else {
                if (!$constructorParameter->isDefaultValueAvailable()) {
                    throw MissingParameterException::create($constructorParameter->getName());
                }
                $value = $constructorParameter->getDefaultValue();
            }

            // TODO: check if sub object!
            $parameters[] = $value;
        }

        $object = $reflectionClass->newInstanceArgs($parameters);

        $this->hydrateObject($data, $object);

        return $object;
    }


    /**
     * Fills $object with $data.
     *
     * @param array $data
     * @param $object
     */
    public function hydrateObject(array $data, $object)
    {
        // TODO
    }
}
