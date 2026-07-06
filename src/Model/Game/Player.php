<?php

namespace App\Model\Game;

use App\Model\Card\CardHand;
use App\Model\Card\Card;
use App\Model\Card\DeckOfCards;

class Player
{
    private int $currentScore;
    private CardHand $hand;

    public bool $stop;

    public function __construct()
    {
        $this->hand = new CardHand();
        $this->currentScore = 0;
        $this->stop = false;

    }

    /**
     * @return Card[]
     */
    public function getPlayerHand(): array
    {
        return $this->hand->getHand();
    }


    public function getScore(): int
    {


        return $this->currentScore;
    }



    public function drawOne(DeckOfCards $deck): void
    {

        $this->hand->takeCard(1, $deck);

        $this->currentScore = 0;
        foreach ($this->hand->getHand() as $card) {
            if ($card->number == 1) {
                $this->currentScore += 14;
                if ($this->currentScore > 21) {
                    $this->currentScore -= 13;
                }
            } else {
                $this->currentScore += $card->number;
            }

        }
    }
}
