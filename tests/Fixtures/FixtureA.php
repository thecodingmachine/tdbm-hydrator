<?php


namespace Mouf\Hydrator\Fixtures;


class FixtureA
{
    private $one;
    private $two;
    private $three;
    private $four;

    /**
     * FixtureA constructor.
     * @param $one
     * @param $two
     * @param int $three
     */
    public function __construct($one, $two, $three = 3)
    {
        $this->one = $one;
        $this->two = $two;
        $this->three = $three;
    }

    /**
     * @return mixed
     */
    public function getOne()
    {
        return $this->one;
    }

    /**
     * @return mixed
     */
    public function getTwo()
    {
        return $this->two;
    }

    /**
     * @return int
     */
    public function getThree()
    {
        return $this->three;
    }

    /**
     * @param int $three
     */
    public function setThree($three)
    {
        throw new \Exception('This should never be called.');
    }

    /**
     * @return mixed
     */
    public function getFour()
    {
        return $this->four;
    }

    /**
     * @param mixed $four
     */
    public function setFour($four)
    {
        $this->four = $four;
    }
    
}
