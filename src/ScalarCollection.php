<?php

declare(strict_types=1);

namespace Serens\TypedCollection;

use InvalidArgumentException;

/**
 * A collection which can only contain specified scalar values.
 * @see ScalarType
 */
class ScalarCollection extends AbstractTypedCollection
{
    public function __construct(protected ScalarType $scalarType, array $items = [])
    {
        parent::__construct($items);
    }

    protected function assertValidItem(mixed $item): void
    {
        if (gettype($item) !== $this->scalarType->value) {
            throw new InvalidArgumentException(sprintf(
                'Adding invalid item of type "%s" to Collection. Expected and only allowed type is "%s".',
                gettype($item),
                $this->scalarType->value
            ));
        }
    }
}
