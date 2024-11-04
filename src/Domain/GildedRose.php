<?php

namespace App\Domain;

final class GildedRose
{
    public function __construct(private readonly ItemsCollection $itemsCollection)
    {
    }

    public function updateQuality(): void
    {
        foreach ($this->itemsCollection->getIterator() as $item) {
            $item->updateQuality();
        }
    }
}
