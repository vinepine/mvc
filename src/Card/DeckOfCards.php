<?php

namespace App\Card;

use App\Card\CardGraphic;

class DeckOfCards
{   
    private $cardList;

    public function __construct()
    {
        $family = ['Clover', 'Spade', 'Hearts', 'Diamond'];
        $number = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
        $this->cardList = [];

        $order = 0;
        foreach ($family as $fam) {
            foreach ($number as $num) {
                $this->cardList[$order] = new CardGraphic($num, $fam);
                $order++;
            }
        }
    }

    public function getCardList()
    {
        return $this->cardList;
    }

    public function shuffleDeck()
    {
        uksort($this->cardList, function () { return rand() > rand(); });;
    }

    public function takeCard()
    {
        return array_pop($this->cardList);
    }

    public function cardsLeft()
    {
        return count($this->cardList);
    }


}
