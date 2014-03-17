<?php
require 'Container.php';

interface SomeInterface{

}

class A{
    protected $classB, $someI;
    public function __construct(B $classB, SomeInterface $someI)
    {
        $this->classB = $classB;
        $this->someI = $someI;
    }
}

class B{

    protected $classC;
    public function __construct(C $classC)
    {
        $this->classC = $classC;
    }
}

class C{
    public function __construct()
    {

    }
}

class D implements SomeInterface{

}

$container = new Container();

//get a instance of A with all injected dependencies
$classA = $container->getInstance('A');
var_dump($classA);
