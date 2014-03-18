<?php
require 'C.php';

class B{
    protected $classC;
    public function __construct(C $classC)
    {
        $this->classC = $classC;
    }
}
