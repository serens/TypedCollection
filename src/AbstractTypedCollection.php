<?php

declare(strict_types=1);

namespace Serens\TypedCollection;

use InvalidArgumentException;

abstract class AbstractTypedCollection extends Collection
{
    public function setItems(array $items): void
    {
        $this->items = [];

        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    public function addItem(mixed $item): void
    {
        $this->assertValidItem($item);
        parent::addItem($item);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->assertValidItem($value);
        parent::offsetSet($offset, $value);
    }

    /**
     * @throws InvalidArgumentException When the added item is invalid (invalid type).
     */
    abstract protected function assertValidItem(mixed $item): void;
}
