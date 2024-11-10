# Typed Collection

Typed Collection is an attempt to use the concept of “Generics” from other
programming languages in PHP as well. Unfortunately, not all advantages can be
realized with current PHP on-board means and syntax.

## Usage and examples

```php
class A {}
class B extends A {}

// Creata a collection which can only contain instances of A.
// Sub classes of A and other classes *are not allowed*:
$collection = new \Serens\TypedCollection\ClassCollection(A::class);
$collection[] = new \A(); // ok
$collection[] = new \B(); // will fail (InvalidArgumentException)

// Creata a collection which can only contain instances of \Iterable.
// Sub classes *are allowed*:
$collection = new \Serens\TypedCollection\InstanceCollection(\Iterator::class);
$collection[] = new \EmptyIterator(); // ok

// Create a collection which can only contain strings:
$collection = new \Serens\TypedCollection\ScalarCollection(\Serens\TypedCollection\ScalarType::STRING);
$collection[] = 'A string can be added to this collection.'; // ok
$collection[] = 324; // will fail (InvalidArgumentException)

// The constructor also accepts initialization values:
$collection = new \Serens\TypedCollection\ScalarCollection(
    \Serens\TypedCollection\ScalarType::STRING,
    [ 'A string', 'Another string', 'The last string' ]
);
```

## ClassCollection vs. InstanceCollection

Both collections work very similarly. The difference is that the
`ClassCollection` can only hold instances of a specific, exact class. The
`InstanceCollection`, on the other hand, can also include instances of
derived classes of the specified parent class. The `InstanceCollection` is
more suitable for interfaces.

## Notes

A major disadvantage is that static code analysis or even the type hinting
of the IDE know nothing about the configured types of a collection. Elements
of type 'mixed' are always recognized for them.

If you absolutely want to use type hinting, you can derive a typed collection
and overwrite all relevant methods and determine the type using PHPDoc.
However, this approach would generate a lot of code that would mainly
consist of parent calls and PHPDocs.
