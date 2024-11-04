<?php

declare(strict_types=1);

namespace App\Domain;

class BackstagePasses extends Item implements ItemInterface
{
    const MAX_QUALITY = 50;
    const DECREASE_QUALITY_BY_2_IN_LAST_DAYS = 10;
    const DECREASE_QUALITY_BY_3_IN_LAST_DAYS = 5;

    public function updateQuality(): void
    {
        if ($this->getQuality() < self::MAX_QUALITY) {
            $this->increaseQuality();

            if ($this->getSellIn() <= self::DECREASE_QUALITY_BY_2_IN_LAST_DAYS) {
                $this->increaseQuality();
            }

            if ($this->getSellIn() <= self::DECREASE_QUALITY_BY_3_IN_LAST_DAYS) {
                $this->increaseQuality();
            }
        }

        $this->decreaseSellIn();

        if ($this->isExpired()) {
            $this->setQuality(0);
        }
    }
}
