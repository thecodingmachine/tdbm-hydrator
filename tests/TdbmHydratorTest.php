<?php


namespace Mouf\Hydrator;


use Mouf\Hydrator\Fixtures\FixtureA;

class TdbmHydratorTest extends \PHPUnit_Framework_TestCase
{
    public function testHydrate()
    {
        $hydrator = new TdbmHydrator();
        $a = $hydrator->hydrateNewObject([
            'one' => 1,
            'two' => 2,
        ], FixtureA::class);

        /** @var $a FixtureA */
        $this->assertEquals(1, $a->getOne());
        $this->assertEquals(2, $a->getTwo());
        $this->assertEquals(3, $a->getThree());
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
}
