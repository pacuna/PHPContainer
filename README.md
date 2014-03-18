PHPContainer
============

Basic php dependency injector (constructor)

Example

```
interface SomeInterface{}

class A{
    protected $someInterface;
    function __construct(SomeInterface $someInterface){
        $this->someInterface = $someinterface;
    }
}

class B implements SomeInterface{}
```

You can resolve this dependency using the container.
First you need to register the bind:

```
$container = new Container();
$container->bind('SomeInterface', 'B');
```

Then you can create the object automatically:

```
$classA = $container->getInstance('A');
```

It also can resolve simple constructor dependencies (without interfaces and no need to register anything)

