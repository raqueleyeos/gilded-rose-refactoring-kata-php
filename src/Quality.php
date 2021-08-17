<?php

namespace GildedRose;

class Quality
{
    private const MAX_QUALITY = 50;
    private const ONE_UNIT = 1;

    private int $quality;

    public function __construct(int $quality)
    {
        $this->quality = $quality;
    }

    public function __toString(): string
    {
        return "$this->quality";
    }

    public function quality(): int
    {
        return $this->quality;
    }

    public function increase(): void
    {
        if (self::MAX_QUALITY > $this->quality) {
            $this->quality += self::ONE_UNIT;
        }
    }

    public function decrease(): void
    {
        if ($this->quality > 0) {
            $this->quality -= self::ONE_UNIT;
        }
    }

    public function decreaseToZero(): void
    {
        $this->quality = 0;
    }
}