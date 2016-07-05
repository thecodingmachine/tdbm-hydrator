<?php
namespace Mouf\Hydrator;


use Mouf\Hydrator\Fixtures\FixtureA;
use Mouf\Hydrator\Fixtures\FixtureB;

class TdbmHydratorTest extends \PHPUnit_Framework_TestCase
{
    public function testHydrateWithConstructor()
    {
        $hydrator = new TdbmHydrator();
        $a = $hydrator->hydrateNewObject([
            'one' => 1,
            'two' => 2,
            'four' => 4
        ], FixtureA::class);

        /** @var $a FixtureA */
        $this->assertEquals(1, $a->getOne());
        $this->assertEquals(2, $a->getTwo());
        $this->assertEquals(3, $a->getThree());
        $this->assertEquals(4, $a->getFour());
    }

    public function testHydrateNull()
    {
        $hydrator = new TdbmHydrator();
        $a = $hydrator->hydrateNewObject([
            'one' => 1,
            'two' => 2,
            'three' => null
        ], FixtureA::class);

        /** @var $a FixtureA */
        $this->assertEquals(1, $a->getOne());
        $this->assertEquals(2, $a->getTwo());
        $this->assertEquals(null, $a->getThree());
    }

    public function testMissingCompulsoryParameter()
    {
        $hydrator = new TdbmHydrator();
        $this->expectException(MissingParameterException::class);
        $hydrator->hydrateNewObject([
            'one' => 1,
        ], FixtureA::class);
    }

    public function testNoHydrateSettersWithMultipleValues()
    {
        $hydrator = new TdbmHydrator();
        $b = $hydrator->hydrateNewObject([
            'one' => 1,
        ], FixtureB::class);

        /** @var $b FixtureB */
        $this->assertEquals(null, $b->getOne());
    }

    public function testHydrate()
    {
        $hydrator = new TdbmHydrator();
        $a = new FixtureA(1 , 2);

        $hydrator->hydrateObject([
            'four' => 4
        ], $a);

        /** @var $a FixtureA */
        $this->assertEquals(4, $a->getFour());
    }

}
