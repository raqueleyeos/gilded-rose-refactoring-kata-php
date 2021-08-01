<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name());
    }

    /**
     * @test
     */
    public function shouldDecreaseSellInByOne(): void
    {
        $item = new Item('foo', 1, 4);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(0, $item->sell_in());
    }

    /**
     * @test
     */
    public function shouldDecreaseQualityByOne(): void
    {
        $item = new Item('foo', 1, 4);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(3, $item->quality());
    }

    /**
     * @test
     */
    public function shouldDegradeByTwoQualityWhenSellInIsPassed(): void
    {
        $item = new Item('foo', 0, 4);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(2, $item->quality());
    }

    /**
     * @test
     */
    public function shouldNeverHaveQualityNegative(): void
    {
        $item = new Item('foo', 1, 0);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(0, $item->quality());
    }

    /**
     * @test
     */
    public function shouldIncreaseQualityByOneWhenAgedBrieGetsOld(): void
    {
        $item = new Item('Aged Brie', 1, 1);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(2, $item->quality());
    }

    /**
     * @test
     */
    public function shouldIncreaseByTwoQualityWhenAgedBrieExpire(): void
    {
        $item = new Item('Aged Brie', 0, 1);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(3, $item->quality());
    }

    /**
     * @test
     */
    public function shouldNeverIncreaseQualityByHigherThan50(): void
    {
        $item = new Item('Aged Brie', 6, 50);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(50, $item->quality());
    }

    /**
     * @test
     */
    public function shouldNeverChangeWhenItemIsSulfuras(): void
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 6, 10);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(6, $item->sell_in());
        $this->assertSame(10, $item->quality());
    }

    /**
     * @test
     */
    public function shouldIncreaseQualityByOneWhenBackstageSellInIsGreaterThanTen(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 11, 10);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(11, $item->quality());
    }

    /**
     * @test
     */
    public function shouldIncreaseQualityByTwoWhenBackstageSellInIsSmallerThanTen(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 9, 10);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(12, $item->quality());
    }

    /**
     * @test
     */
    public function shouldIncreaseQualityByThreeWhenBackstageSellInIsSmallerOrEqualThanFive(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 10);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(13, $item->quality());
    }

    /**
     * @test
     */
    public function shouldLoseQualityWhenBackstageSellInPasses(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 50);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(0, $item->quality());
    }
}
