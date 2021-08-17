<?php

namespace GildedRose;

final class ItemFactory
{
    private const AGED_BRIE = 'Aged Brie';
    private const SULFURAS_HAND_OF_RAGNAROS = 'Sulfuras, Hand of Ragnaros';
    private const BACKSTAGE_PASSES_TO_A_TAFKAL80ETC_CONCERT = 'Backstage passes to a TAFKAL80ETC concert';

    public static function create(string $name, int $sellIn, int $quality): Item
    {
        if (self::AGED_BRIE === $name) {
            return new AgedBrie($name, $sellIn, $quality);
        }

        if (self::SULFURAS_HAND_OF_RAGNAROS === $name) {
            return new SulfurasHandOfRagnaros($name, $sellIn, $quality);
        }

        if (self::BACKSTAGE_PASSES_TO_A_TAFKAL80ETC_CONCERT === $name) {
            return new BackstagePassesToATAFKAL80ETCConcert($name, $sellIn, $quality);
        }

        return new GenericItem($name, $sellIn, $quality);
    }
}