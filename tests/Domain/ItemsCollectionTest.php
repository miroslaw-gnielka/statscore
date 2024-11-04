<?php

declare(strict_types=1);

namespace App\Tests\Domain;

use App\Domain\Exception\InvalidItemTypeException;
use App\Domain\ItemsCollection;
use App\Tests\Builder\ItemBuilder;
use PHPUnit\Framework\TestCase;

class ItemsCollectionTest extends TestCase
{
    /** @test */
    public function create_collection_with_correct_types(): void
    {
        //with
        $item = ItemBuilder::any()
            ->build();

        //when
        $itemsCollection = new ItemsCollection(items: [$item]);

        //then
        $this->assertCount(1, $itemsCollection->getIterator());
    }

    /** @test */
    public function cant_create_collection_with_incorrect_types(): void
    {
        //then
        $this->expectException(InvalidItemTypeException::class);
        $this->expectExceptionMessage('Invalid item type');

        //when
        new ItemsCollection(items: [new \stdClass()]);
    }
}
