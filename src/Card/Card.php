<?php

namespace App\Card;

class Card
{
    public int $number;
    public string $family;


    public function __construct(int $number, string $family)
    {
        $this->number = $number;
        $this->family = $family;
    }

    public function toString(): string
    {

        return "$this->number, $this->family";
    }
}
