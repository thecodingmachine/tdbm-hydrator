<?php


namespace Mouf\Hydrator\Fixtures;


class FixtureB
{
    private $one;

    /**
     * @return mixed
     */
    public function getOne()
    {
        return $this->one;
    }

    /**
     * @param mixed $one
     */
    public function setOne($one, $two)
    {
        $this->one = $one;
    }
}
