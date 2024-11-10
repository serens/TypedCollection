<?php

declare(strict_types=1);

namespace Serens\TypedCollection\Tests;

use PHPUnit\Framework\TestCase;
use Serens\TypedCollection\ClassCollection;

final class ClassCollectionTest extends TestCase
{
    public function testCollectionCanBeConstructedWithValidClassname(): void
    {
        $this->assertInstanceOf(ClassCollection::class, new ClassCollection(\DateTime::class));
    }

    public function testConstructorThrowsExceptionWhenInvalidClassnameGiven(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new ClassCollection('Vendor\Unknown\Classname'));
    }

    public function testAddingValidItemsToCollection(): void
    {
        $this->assertEquals(1, (new ClassCollection(\DateTime::class, [ new \DateTime() ]))->count());
    }

    public function testAddingInvalidItemsThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new ClassCollection(\DateTime::class, [ new \DateTimeZone('Europe/Berlin') ]));
    }
}