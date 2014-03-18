<?php
require 'DummyClasses/A.php';
require 'DummyClasses/F.php';
require __DIR__.'/../Container.php';

class ContainerTest extends PHPUnit_Framework_TestCase
{

    protected $container;
    public function setUp()
    {
        $this->container = new Container();
    }
    //tests if can create an instance of Class A
    //that has a constructor dependency on class B
    public function testCanResolveSimpleClass()
    {
        $classA = $this->container->getInstance('A');
        $this->assertInstanceOf('A', $classA);
    }

    //class B has a constructor dependency on class C
    //which has another constructor dependency on class D
    public function testItCanResolveRecursively()
    {
        $classB = $this->container->getInstance('B');
        $this->assertInstanceOf('B', $classB);
    }

    //class E has a construct dependency on SomeInterface and
    //class F is a concrete implementation of Someinterface
    //We register this dependency in the container and test
    //the resolution
    public function testItCanResolveInterfaceInjection()
    {
        $this->container->bind('SomeInterface', 'F');
        $classE = $this->container->getInstance('E');
        $this->assertInstanceOf('E', $classE);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Entry not found in the container.
     */
    public function testItThrowsExceptionWhenCannotFoundDependency()
    {
        $this->container->getEntryDependency('NotDeclarated');
    }
}
