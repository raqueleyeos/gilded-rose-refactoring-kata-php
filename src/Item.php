<?php

declare(strict_types=1);

namespace GildedRose;

abstract class Item
{
    private string $name;

    private SellIn $sellIn;

    private Quality $quality;

    public function __construct(string $name, int $sellIn, int $quality)
    {
        $this->name = $name;
        $this->sellIn = new SellIn($sellIn);
        $this->quality = new Quality($quality);
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sellIn}, {$this->quality}";
    }

    public function name(): string
    {
        return $this->name;
    }

    public function sellIn(): int
    {
        return $this->sellIn->sellIn();
    }

    public function quality(): int
    {
        return $this->quality->quality();
    }

    public function increaseQuality(): void
    {
        $this->quality->increase();
    }

    public function decreaseQuality(): void
    {
        $this->quality->decrease();
    }

    public function decreaseQualityToZero(): void
    {
        $this->quality->decreaseToZero();
    }

    public function decreaseSellIn(): void
    {
        $this->sellIn->decrease();
    }

    public function hasSellInExpired(): bool
    {
        return $this->sellIn->hasExpired();
    }

    public function areTheseDaysOrLessLeftToSellIn(int $days): bool
    {
        return $this->sellIn->areTheseDaysOrLessLeft($days);
    }

    abstract public function update(): void;
}
