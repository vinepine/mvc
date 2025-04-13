<?php

namespace App\Card;

use App\Card\DeckOfCards;

class CardHand
{
    public $listOfCards;
    public function __construct()
    {
        $this->listOfCards = [];
    }

    public function getHand()
    {
        return $this->listOfCards;
    }

    public function takeCard($amount, $deck)
    {
        if ($deck->cardsLeft() > 0) {
            for ($i = 0; $i < $amount; $i++) {
                if ($deck->cardsLeft() === 0) {
                    break;
                }
                $this->listOfCards[] = $deck->takeCard();
            }
        }
    }
}
