<?php
namespace Mouf\Hydrator;

interface Hydrator
{
    /**
     * Creates a new $className object, filling it with $data.
     *
     * @param array $data
     * @param string $className
     * @return object
     */
    public function hydrateNewObject(array $data, string $className);

    /**
     * Fills $object with $data.
     *
     * @param array $data
     * @param $object
     * @return object
     */
    public function hydrateObject(array $data, $object);
}