<?php
require 'B.php';

class A{

    protected $classB;
    public function __construct(B $classB)
    {
        $this->classB = $classB;
    }
}
