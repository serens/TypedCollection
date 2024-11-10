<?php

declare(strict_types=1);

namespace Serens\TypedCollection\Tests;

use PHPUnit\Framework\TestCase;
use Serens\TypedCollection\ScalarCollection;
use Serens\TypedCollection\ScalarType;

final class ScalarCollectionTest extends TestCase
{
    public function testCollectionCanBeConstructedWithValidScalarType(): void
    {
        foreach (ScalarType::cases() as $scalarType) {
            $this->assertInstanceOf(ScalarCollection::class, new ScalarCollection($scalarType));
        }
    }

    public function testAddingValidItemsToCollection(): void
    {
        $this->assertEquals(1, (new ScalarCollection(ScalarType::ARRAY, [ ['An array'] ]))->count());
        $this->assertEquals(1, (new ScalarCollection(ScalarType::BOOL, [ true ]))->count());
        $this->assertEquals(1, (new ScalarCollection(ScalarType::DOUBLE, [ 15.345 ]))->count());
        $this->assertEquals(1, (new ScalarCollection(ScalarType::INT, [ 4 ]))->count());
        $this->assertEquals(1, (new ScalarCollection(ScalarType::STRING, [ 'A string' ]))->count());
    }

    public function testAddingInvalidItemsThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new ScalarCollection(ScalarType::STRING, [ 35 ]));
    }
}