<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class ApprovalTest extends TestCase
{
    public function useCases(): array
    {
        return [
            '2 days' => [
                'items' => [
                    [
                        'name' => '+5 Dexterity Vest',
                        'sellIn' => 10,
                        'quality' => 20,
                    ],
                    [
                        'name' => 'Aged Brie',
                        'sellIn' => 2,
                        'quality' => 0,
                    ],
                    [
                        'name' => 'Elixir of the Mongoose',
                        'sellIn' => 5,
                        'quality' => 7,
                    ],
                    [
                        'name' => 'Sulfuras, Hand of Ragnaros',
                        'sellIn' => 0,
                        'quality' => 80,
                    ],
                    [
                        'name' => 'Sulfuras, Hand of Ragnaros',
                        'sellIn' => -1,
                        'quality' => 80,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 15,
                        'quality' => 20,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 10,
                        'quality' => 49,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 5,
                        'quality' => 49,
                    ],
                    [
                        'name' => 'Conjured Mana Cake',
                        'sellIn' => 3,
                        'quality' => 6,
                    ],
                ],
                'days' => 2,
                'expectedList' => [
                    [
                        'name' => '+5 Dexterity Vest',
                        'sellIn' => 8,
                        'quality' => 18,
                    ],
                    [
                        'name' => 'Aged Brie',
                        'sellIn' => 0,
                        'quality' => 2,
                    ],
                    [
                        'name' => 'Elixir of the Mongoose',
                        'sellIn' => 3,
                        'quality' => 5,
                    ],
                    [
                        'name' => 'Sulfuras, Hand of Ragnaros',
                        'sellIn' => 0,
                        'quality' => 80,
                    ],
                    [
                        'name' => 'Sulfuras, Hand of Ragnaros',
                        'sellIn' => -1,
                        'quality' => 80,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 13,
                        'quality' => 22,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 8,
                        'quality' => 50,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 3,
                        'quality' => 50,
                    ],
                    [
                        'name' => 'Conjured Mana Cake',
                        'sellIn' => 1,
                        'quality' => 4,
                    ],
                ],
            ],
            '31 days' => [
                'items' => [

                    [
                        'name' => '+5 Dexterity Vest',
                        'sellIn' => 10,
                        'quality' => 20,
                    ],
                    [
                        'name' => 'Aged Brie',
                        'sellIn' => 2,
                        'quality' => 0,
                    ],
                    [
                        'name' => 'Elixir of the Mongoose',
                        'sellIn' => 5,
                        'quality' => 7,
                    ],
                    [
                        'name' => 'Sulfuras, Hand of Ragnaros',
                        'sellIn' => 0,
                        'quality' => 80,
                    ],
                    [
                        'name' => 'Sulfuras, Hand of Ragnaros',
                        'sellIn' => -1,
                        'quality' => 80,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 15,
                        'quality' => 20,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 10,
                        'quality' => 49,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => 5,
                        'quality' => 49,
                    ],
                    [
                        'name' => 'Conjured Mana Cake',
                        'sellIn' => 3,
                        'quality' => 6,
                    ],
                ],
                'days' => 31,
                'expectedList' => [
                    [
                        'name' => '+5 Dexterity Vest',
                        'sellIn' => -21,
                        'quality' => 0,
                    ],
                    [
                        'name' => 'Aged Brie',
                        'sellIn' => -29,
                        'quality' => 50,
                    ],
                    [
                        'name' => 'Elixir of the Mongoose',
                        'sellIn' => -26,
                        'quality' => 0,
                    ],
                    [
                        'name' => 'Sulfuras, Hand of Ragnaros',
                        'sellIn' => 0,
                        'quality' => 80,
                    ],
                    [
                        'name' => 'Sulfuras, Hand of Ragnaros',
                        'sellIn' => -1,
                        'quality' => 80,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => -16,
                        'quality' => 0,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => -21,
                        'quality' => 0,
                    ],
                    [
                        'name' => 'Backstage passes to a TAFKAL80ETC concert',
                        'sellIn' => -26,
                        'quality' => 0,
                    ],
                    [
                        'name' => 'Conjured Mana Cake',
                        'sellIn' => -28,
                        'quality' => 0,
                    ],
                ]
            ],
        ] ;
    }

    /**
     * @dataProvider useCases
     */
    public function testGildedRose(array $items, int $days, array $expectedList): void
    {
        $itemList = [];
        foreach ($items as $data) {
            $item = new Item($data['name'], $data['sellIn'], $data['quality']);
            array_push($itemList, $item);
        }

        $app = new GildedRose($itemList);

        for ($i = 0; $i < $days; $i++) {
            $app->updateQuality();
        }

        for($pos = 0; $pos < count($itemList); $pos++) {
            $item = $itemList[$pos];
            $expected = $expectedList[$pos];

            $this->assertEquals($expected['name'], $item->name());
            $this->assertEquals($expected['sellIn'], $item->sell_in());
            $this->assertEquals($expected['quality'], $item->quality());
        }
    }
}
