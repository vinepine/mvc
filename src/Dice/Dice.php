<?php

namespace App\Dice;

class Dice
{
    protected $value;

    public function __construct()
    {
        $this->value = null;
    }

    public function roll()
    {
        $this->value = random_int(1, 6);
        return $this->value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getAsString()
    {
        return "{$this->value}";
    }
}
