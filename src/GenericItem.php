<?php

namespace GildedRose;

class GenericItem extends Item
{
    public function update(): void
    {
        $this->decreaseQuality();
        $this->decreaseSellIn();
        if ($this->hasSellInExpired()) {
            $this->decreaseQuality();
        }
    }
}