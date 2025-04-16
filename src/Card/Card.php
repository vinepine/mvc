<?php

namespace App\Card;

class Card
{
    public $number;
    public $family;


    public function __construct($number, $family)
    {
        $this->number = $number;
        $this->family = $family;
    }

    public function toString()
    {

        return "$this->number, $this->family";
    }
}
