<?php

declare(strict_types=1);

namespace Serens\TypedCollection\Tests;

use PHPUnit\Framework\TestCase;
use Serens\TypedCollection\InstanceCollection;

final class InstanceCollectionTest extends TestCase
{
    public function testCollectionCanBeConstructedWithValidClassname(): void
    {
        $this->assertInstanceOf(InstanceCollection::class, new InstanceCollection(\DateTime::class));
    }

    public function testConstructorThrowsExceptionWhenInvalidClassnameGiven(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new InstanceCollection('Vendor\Unknown\Interface'));
    }

    public function testAddingValidItemsToCollection(): void
    {
        $this->assertEquals(1, (new InstanceCollection(\Iterator::class, [ new \EmptyIterator() ]))->count());
    }

    public function testAddingInvalidItemsThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new InstanceCollection(\Iterator::class, [ new \DateTimeZone('Europe/Berlin') ]));
    }
}