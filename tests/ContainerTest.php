<?php
require 'DummyClasses/A.php';
require 'DummyClasses/F.php';
require __DIR__.'/../Container.php';

class ContainerTest extends PHPUnit_Framework_TestCase
{
    //tests if can create an instance of Class A
    //that has a constructor dependency on class B
    public function testCanResolveSimpleClass()
    {
        $container = new Container();
        $classA = $container->getInstance('A');
        $this->assertInstanceOf('A', $classA);
    }

    //class B has a constructor dependency on class C
    //which has another constructor dependency on class D
    public function testItCanResolveRecursively()
    {
        $container = new Container();
        $classB = $container->getInstance('B');
        $this->assertInstanceOf('B', $classB);
    }

    //class E has a construct dependency on SomeInterface and
    //class F is a concrete implementation of Someinterface
    //We register this dependency in the container and test
    //the resolution
    public function testItCanResolveInterfaceInjection()
    {
        $container = new Container();
        $container->bind('SomeInterface', 'F');
        $classE = $container->getInstance('E');
        $this->assertInstanceOf('E', $classE);
    }
}
