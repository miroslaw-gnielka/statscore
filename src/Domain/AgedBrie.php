<?php

declare(strict_types=1);

namespace App\Domain;

class AgedBrie extends Item implements ItemInterface
{
    const MAX_QUALITY = 50;

    public function updateQuality(): void
    {
        if ($this->getQuality() < self::MAX_QUALITY) {
            $this->increaseQuality();
        }

        $this->decreaseSellIn();

        if ($this->isExpired() && $this->getQuality() < self::MAX_QUALITY) {
            $this->increaseQuality();
        }
    }
}
