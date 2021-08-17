<?php

namespace GildedRose;

class SellIn
{
    private const ONE_UNIT = 1;

    private int $sellIn;

    public function __construct(int $sellIn)
    {
        $this->sellIn = $sellIn;
    }

    public function __toString(): string
    {
        return "$this->sellIn";
    }

    public function sellIn(): int
    {
        return $this->sellIn;
    }

    public function decrease(): void
    {
        $this->sellIn -= self::ONE_UNIT;
    }

    public function hasExpired(): bool
    {
        return $this->sellIn < 0;
    }

    public function areTheseDaysOrLessLeft(int $days): bool
    {
        return $days > $this->sellIn;
    }


}