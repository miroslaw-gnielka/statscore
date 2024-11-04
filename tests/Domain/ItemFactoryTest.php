<?php

declare(strict_types=1);

namespace App\Tests\Domain;

use App\Domain\AgedBrie;
use App\Domain\BackstagePasses;
use App\Domain\CommonItem;
use App\Domain\Exception\InvalidItemQualityException;
use App\Domain\ItemFactory;
use App\Domain\ItemInterface;
use App\Domain\Sulfuras;
use PHPUnit\Framework\TestCase;

class ItemFactoryTest extends TestCase
{
    /**
     * @dataProvider itemsProvider
     * @test
     */
    public function create_correct_item(string $name, int $sellIn, int $quality, ItemInterface $expectedItem): void
    {
        //when
        $createdItem = ItemFactory::create($name, $sellIn, $quality);

        //then
        $this->assertEquals($expectedItem, $createdItem);
    }

    /** @test */
    public function cant_create_item_with_incorrect_quality(): void
    {
        $this->expectException(InvalidItemQualityException::class);
        $this->expectExceptionMessage('Item quality must be greater than 0');

        ItemFactory::create('foo bar', 10, -10);
    }

    public function itemsProvider(): array
    {
        return [
            'Aged Brie before sell in date' => [
                'Aged Brie',
                10,
                10,
                new AgedBrie('Aged Brie', 10, 10)
            ],
            'Backstage passes before sell in date' => [
                'Backstage passes to a TAFKAL80ETC concert',
                10,
                10,
                new BackstagePasses('Backstage passes to a TAFKAL80ETC concert', 10, 10)
            ],
            'Sulfuras before sell in date' => [
                'Sulfuras, Hand of Ragnaros',
                10,
                80,
                new Sulfuras('Sulfuras, Hand of Ragnaros', 10, 80)
            ],
            'Elixir of the Mongoose before sell in date' => [
                'Elixir of the Mongoose',
                10,
                10,
                new CommonItem('Elixir of the Mongoose', 10, 10)
            ],
            'Foo bar' => ['Foo bar', 69, 50, new CommonItem('Foo bar', 69, 50)]
        ];
    }
}
