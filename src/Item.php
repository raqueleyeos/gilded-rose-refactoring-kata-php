<?php

declare(strict_types=1);

namespace GildedRose;

final class Item
{
    public string $name;

    public int $sell_in;

    public int $quality;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

    public function name(): string
    {
        return $this->name;
    }

    public function sell_in(): int
    {
        return $this->sell_in;
    }

    public function quality(): int
    {
        return $this->quality;
    }
}
