<?php

declare(strict_types=1);

namespace App\Domain;

class CommonItem extends Item implements ItemInterface
{
    public function updateQuality(): void
    {
        if ($this->getQuality() > self::MIN_QUALITY) {
            $this->decreaseQuality();
        }

        $this->decreaseSellIn();

        if ($this->isExpired() && $this->getQuality() > self::MIN_QUALITY) {
            $this->decreaseQuality();
        }
    }
}
