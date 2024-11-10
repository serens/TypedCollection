<?php

declare(strict_types=1);

namespace Serens\TypedCollection;

use InvalidArgumentException;

/**
 * A collection which can only contain instances of a specific class.
 */
class ClassCollection extends AbstractTypedCollection
{
    public function __construct(protected string $className, array $items = [])
    {
        if (!class_exists($this->className)) {
            throw new InvalidArgumentException(sprintf(
                'Invalid class name: "%s". A known and fully qualified class name must be provided.',
                $className
            ));
        }

        parent::__construct($items);
    }

    protected function assertValidItem(mixed $item): void
    {
        if ($item::class !== $this->className) {
            throw new InvalidArgumentException(sprintf(
                'Adding invalid instance of type "%s" to Collection. Expected and only allowed type is "%s".',
                $item::class,
                $this->className
            ));
        }
    }
}
