<?php

namespace GildedRose;

class AgedBrie extends Item
{
    public function update(): void
    {
        $this->decreaseSellIn();
        $this->increaseQuality();

        if ($this->hasSellInExpired()) {
            $this->increaseQuality();
        }
    }
}