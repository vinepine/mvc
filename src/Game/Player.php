<?php

namespace App\Game;

use App\Card\CardHand;

class Player {

    private int $currentScore;
    private CardHand $hand;

    public bool $stop;

    public function __construct()
    {
        $this->hand = new CardHand();
        $this->currentScore = 0;
        $this->stop = False;
    }

    public function getPlayerHand() 
    {
        return $this->hand->getHand();
    }


    public function getScore() 
    {
        return $this->currentScore;
    }

    public function drawOne($deck): void
    {   

        $this->hand->takeCard(1, $deck);

        $cardList = $this->hand->getHand();

        $this->currentScore = 0;
        foreach ($cardList as $card){
            $this->currentScore += $card->number;
        }
    }
}
