<?php


namespace Mouf\Hydrator;


use Stringy\StaticStringy;
use function Stringy\create as s;

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
        $underscoredData = $this->underscoreData($data);
        $parameters = [];

        $constructor = $reflectionClass->getConstructor();

        if ($constructor !== null) {
            $constructorParameters = $constructor->getParameters();

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
        }

        $object = $reflectionClass->newInstanceArgs($parameters);

        $this->hydrateObjectFromUnderscoredData($underscoredData, $object);

        return $object;
    }

    /**
     * Underscores the keys of the array.
     *
     * @param array $data
     */
    private function underscoreData(array $data)
    {
        $underscoredData = [];
        foreach ($data as $key => $value) {
            $underscoredData[(string) StaticStringy::underscored($key)] = $value;
        }
        return $underscoredData;
    }

    /**
     * Fills $object with $data.
     *
     * @param array $data
     * @param $object
     */
    public function hydrateObject(array $data, $object)
    {
        $underscoredData = $this->underscoreData($data);
        $this->hydrateObjectFromUnderscoredData($underscoredData, $object);
    }

    private function hydrateObjectFromUnderscoredData(array $underscoredData, $object)
    {
        $reflectionClass = new \ReflectionClass($object);

        $setters = $this->getSetters($reflectionClass);

        foreach ($setters as $underscoredName => $setter) {

            if (array_key_exists($underscoredName, $underscoredData)) {
                $value = $underscoredData[$underscoredName];
                unset($underscoredData[$underscoredName]);
                $setterName = $setter->getName();

                $object->$setterName($value);
            }

            // TODO: check if sub object!
        }
    }

    /**
     * Returns an array of setters reflection methods, indexed by "underscored" name.
     *
     * @param \ReflectionClass $reflectionClass
     * @return \ReflectionMethod[]
     */
    private function getSetters(\ReflectionClass $reflectionClass) {
        $reflectionMethods = $reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC);

        $setters = [];

        foreach ($reflectionMethods as $reflectionMethod) {
            $methodName = s($reflectionMethod->getName());
            $parameters = $reflectionMethod->getParameters();
            if ($methodName->startsWith('set') && count($parameters) >= 1) {
                // Let's check that the setter has no more than 1 compulsory parameter.
                array_shift($parameters);
                foreach ($parameters as $optionalParameters) {
                    if (!$optionalParameters->isDefaultValueAvailable()) {
                        continue 2;
                    }
                }
                $underscored = (string) $methodName->substr(3)->underscored();
                $setters[$underscored] = $reflectionMethod;
            }
        }

        return $setters;
    }
}
