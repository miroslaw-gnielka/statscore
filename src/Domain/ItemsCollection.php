<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\InvalidItemTypeException;
use ArrayIterator;
use IteratorAggregate;
use Traversable;

class ItemsCollection implements IteratorAggregate
{
    /**
     * @param ItemInterface[] $items
     */
    public function __construct(private readonly array $items)
    {
        foreach ($this->items as $item) {
            if (false === $this->isValid($item)) {
                throw new InvalidItemTypeException('Invalid item type');
            }
        }
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    private function isValid(mixed $item): bool
    {
        // this can be also in some Specification interface to validate this
        return $item instanceof ItemInterface;
    }
}
