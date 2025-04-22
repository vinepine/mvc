<?php

namespace App\Card;

use App\Card\DeckOfCards;

class CardHand
{
    /** @var Card[] */
    public array $listOfCards;
    public function __construct()
    {
        $this->listOfCards = [];
    }

    /**
     * @return Card[]
     */
    public function getHand(): array
    {
        return $this->listOfCards;
    }

    public function takeCard(int $amount, DeckOfCards $deck): void
    {

        for ($i = 0; $i < $amount; $i++) {
            if ($deck->cardsLeft() === 0) {
                break;
            }
            $this->listOfCards[] = $deck->takeCard();
        }

    }
}
