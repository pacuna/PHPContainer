<?php
require 'D.php';
class C{
    protected $classD;
    public function __construct(D $classD)
    {
        $this->classD = $classD;
    }
}
