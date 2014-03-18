<?php
require 'SomeInterface.php';

class F implements SomeInterface{

}

class E{
    protected $someInterface;

    public function __construct(SomeInterface $someInterface){
        $this->someInterface = $someInterface;
    }
}
