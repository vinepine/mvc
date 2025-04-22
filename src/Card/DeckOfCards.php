<?php

namespace App\Card;

use App\Card\CardGraphic;

class DeckOfCards
{
    /**
     * @var Card[]
     */
    private array $cardList;

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

    /**
     * @return Card[]
     */
    public function getCardList(): array
    {
        return $this->cardList;
    }

    public function shuffleDeck(): void
    {
        $keys = array_keys($this->cardList);
        shuffle($keys);

        $shuffled = [];
        foreach ($keys as $key) {
            $shuffled[$key] = $this->cardList[$key];
        }
        $this->cardList = $shuffled;
    }

    public function takeCard(): Card
    {
        return array_pop($this->cardList);
    }

    public function cardsLeft(): int
    {
        return count($this->cardList);
    }
}
