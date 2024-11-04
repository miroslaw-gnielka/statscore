<?php

declare(strict_types=1);

namespace App\Tests\Builder;

use App\Domain\ItemFactory;
use App\Domain\ItemInterface;

class ItemBuilder
{
    const NAMES = ['Aged Brie', 'Backstage passes to a TAFKAL80ETC concert', 'Sulfuras, Hand of Ragnaros', 'FOO BAR'];

    private string $name;
    private int $sellIn;
    private int $quality;

    public static function any(): self
    {
        return (new self())->random();
    }

    public function random(): self
    {
        $this->name = self::NAMES[rand(0, count(self::NAMES) - 1)];
        $this->sellIn = rand(0, 100);
        $this->quality = rand(0, 50);

        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withSellIn(int $sellIn): self
    {
        $this->sellIn = $sellIn;

        return $this;
    }

    public function withQuality(int $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    public function build(): ItemInterface
    {
        return ItemFactory::create($this->name, $this->sellIn, $this->quality);
    }
}
