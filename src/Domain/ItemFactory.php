<?php

declare(strict_types=1);

namespace App\Domain;

class ItemFactory
{
    public static function create(string $name, int $sellIn, int $quality): ItemInterface
    {
        return match ($name) {
            'Aged Brie' => new AgedBrie($name, $sellIn, $quality),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePasses($name, $sellIn, $quality),
            'Sulfuras, Hand of Ragnaros' => new Sulfuras($name, $sellIn, $quality),
            default => new CommonItem($name, $sellIn, $quality),
        };
    }
}
