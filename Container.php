<?php
require 'Config.php';

class Container{
    private $entries = array();

    //load the dependecies declarated in dependencies.php
    public function __construct()
    {
        $this->entries = Config::load('dependencies.php');
    }

    //get instance of a class
    public function getInstance($className)
    {
        $dependencies = [];
        $class = new ReflectionClass($className);

        if(!is_null($class->getConstructor()))
        {
            $params = $class->getConstructor()->getParameters();
            foreach($params as $type){
                $dependencieClassName = $type->getClass()->name;
                $reflectionClass = new ReflectionClass($dependencieClassName);
                if($reflectionClass->isInstantiable()){

                    //use recursivness to get the dependecies of the dependencies
                    $dependencies[] = $this->getInstance($dependencieClassName);
                }

                //automatic resolution of interfaces via file declaration (dependencies.php)
                elseif($reflectionClass->isInterface()){
                    $implementation = $this->getEntryDependency($reflectionClass->getName());
                    $concrete= $this->getInstance($implementation);
                    $dependencies[] = $concrete;
                }
            }
        }

        //if class has no constructor then dependecies are empty
        $finalInstance = $class->newInstanceArgs($dependencies);
        return $finalInstance;
    }

    public function resolve($type)
    {

    }

    //bind a dependency
    public function bind($entry, $dependency)
    {
        $this->entries[$entry] = $dependency;
    }

    //return dependency for a class
    public function getEntryDependency($entry)
    {
        return $this->entries[$entry];
    }

}
