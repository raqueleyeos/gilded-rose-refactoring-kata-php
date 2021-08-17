<?php

namespace GildedRose;

class BackstagePassesToATAFKAL80ETCConcert extends Item
{
    private const MAX_TEN_DAYS = 10;
    private const MAX_FIVE_DAYS = 5;

    public function update(): void
    {
        $this->increaseQuality();
        $this->decreaseSellIn();

        if ($this->areTheseDaysOrLessLeftToSellIn(self::MAX_TEN_DAYS)) {
           $this->increaseQuality();
        }

        if ($this->areTheseDaysOrLessLeftToSellIn(self::MAX_FIVE_DAYS)) {
            $this->increaseQuality();
        }

        if ($this->hasSellInExpired()) {
            $this->decreaseQualityToZero();
        }
    }
}