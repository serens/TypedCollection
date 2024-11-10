<?php

declare(strict_types=1);

namespace Serens\TypedCollection;

use InvalidArgumentException;

/**
 * A collection which can contain classes and sub classes as well.
 */
class InstanceCollection extends AbstractTypedCollection
{
    public function __construct(protected string $className, array $items = [])
    {
        if (!class_exists($this->className) && !interface_exists($this->className)) {
            throw new InvalidArgumentException(sprintf(
                'Invalid class name: "%s". A known and fully qualified class or interface name must be provided.',
                $className
            ));
        }

        parent::__construct($items);
    }

    protected function assertValidItem(mixed $item): void
    {
        if (!$item instanceof $this->className) {
            throw new InvalidArgumentException(sprintf(
                'Adding invalid instance of type "%s" to Collection. Item must be an instance of "%s".',
                gettype($item),
                $this->className
            ));
        }
    }
}
