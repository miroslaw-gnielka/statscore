<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\InvalidItemQualityException;

abstract class Item
{
    function __construct(private string $name, private int $sellIn, private int $quality)
    {
        if (false === $this->isValid($quality)) {
            // ALL those exceptions need to be handled on freamework level.
            // Basically MUST be handled before returning result to client.
            // thinking about some Middleware
            throw new InvalidItemQualityException('Item quality must be greater than 0');
        }
    }

    public function getSellIn(): int
    {
        return $this->sellIn;
    }

    public function isExpired(): bool
    {
        return $this->sellIn < 0;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function increaseQuality(): void
    {
        $this->quality++;
    }

    public function decreaseQuality(): void
    {
        $this->quality--;
    }

    public function setQuality(int $quality): void
    {
        $this->quality = $quality;
    }

    public function decreaseSellIn(): void
    {
        $this->sellIn--;
    }

    private function isValid(int $quality): bool
    {
        // this can be also in some Specification interface to validate this
        return $quality >= ItemInterface::MIN_QUALITY;
    }
}
