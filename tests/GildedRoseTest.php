<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\ItemFactory;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $item = ItemFactory::create('foo', 0, 0);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $item->name());
    }

    /**
     * @test
     */
    public function shouldDecreaseSellInByOne(): void
    {
        $item = ItemFactory::create('foo', 1, 4);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(0, $item->sellIn());
    }

    /**
     * @test
     */
    public function shouldDecreaseQualityByOne(): void
    {
        $item = ItemFactory::create('foo', 1, 4);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(3, $item->quality());
    }

    /**
     * @test
     */
    public function shouldDegradeByTwoQualityWhenSellInIsPassed(): void
    {
        $item = ItemFactory::create('foo', 0, 4);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(2, $item->quality());
    }

    /**
     * @test
     */
    public function shouldNeverHaveQualityNegative(): void
    {
        $item = ItemFactory::create('foo', 1, 0);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(0, $item->quality());
    }

    /**
     * @test
     */
    public function shouldIncreaseQualityByOneWhenAgedBrieGetsOld(): void
    {
        $item = ItemFactory::create('Aged Brie', 1, 1);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(2, $item->quality());
    }

    /**
     * @test
     */
    public function shouldIncreaseByTwoQualityWhenAgedBrieExpire(): void
    {
        $item = ItemFactory::create('Aged Brie', 0, 1);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(3, $item->quality());
    }

    /**
     * @test
     */
    public function shouldNeverIncreaseQualityByHigherThan50(): void
    {
        $item = ItemFactory::create('Aged Brie', 6, 50);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(50, $item->quality());
    }

    /**
     * @test
     */
    public function shouldNeverChangeWhenItemIsSulfuras(): void
    {
        $item = ItemFactory::create('Sulfuras, Hand of Ragnaros', 6, 10);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(6, $item->sellIn());
        $this->assertSame(10, $item->quality());
    }

    /**
     * @test
     */
    public function shouldIncreaseQualityByOneWhenBackstageSellInIsGreaterThanTen(): void
    {
        $item = ItemFactory::create('Backstage passes to a TAFKAL80ETC concert', 11, 10);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(11, $item->quality());
    }

    /**
     * @test
     */
    public function shouldIncreaseQualityByTwoWhenBackstageSellInIsSmallerThanTen(): void
    {
        $item = ItemFactory::create('Backstage passes to a TAFKAL80ETC concert', 9, 10);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(12, $item->quality());
    }

    /**
     * @test
     */
    public function shouldIncreaseQualityByThreeWhenBackstageSellInIsSmallerOrEqualThanFive(): void
    {
        $item = ItemFactory::create('Backstage passes to a TAFKAL80ETC concert', 5, 10);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(13, $item->quality());
    }

    /**
     * @test
     */
    public function shouldLoseQualityWhenBackstageSellInPasses(): void
    {
        $item = ItemFactory::create('Backstage passes to a TAFKAL80ETC concert', 0, 50);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertSame(0, $item->quality());
    }
}
