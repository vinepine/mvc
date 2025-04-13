<?php

namespace App\Card;

use App\Card\Card;

class CardGraphic extends Card
{
    private $cardSpade;
    private $cardHeart;
    private $cardDiamond;
    private $cardClover;
    private $card;

    public function __construct($number, $family)
    {
        parent::__construct($number, $family);

        $this->cardSpade = ['🂡', '🂢', '🂣', '🂤', '🂥', '🂦', '🂧', '🂨', '🂩', '🂪', '🂫', '🂭', '🂮'];
        $this->cardHeart = ['🂱', '🂲', '🂳', '🂴', '🂵', '🂶', '🂷', '🂸', '🂹', '🂺', '🂻', '🂽', '🂾'];
        $this->cardDiamond = ['🃁', '🃂', '🃃', '🃄', '🃅', '🃆', '🃇', '🃈', '🃉', '🃊', '🃋', '🃍', '🃎'];
        $this->cardClover = ['🃑', '🃒', '🃓', '🃔', '🃕', '🃖', '🃗', '🃘', '🃙', '🃚', '🃛', '🃝', '🃞'];
    }

    public function toString()
    {
        if ($this->family === 'Hearts') {
            $this->card = $this->cardHeart[$this->number - 1];
        } elseif ($this->family === 'Spade') {
            $this->card = $this->cardSpade[$this->number - 1];
        } elseif ($this->family === 'Diamond') {
            $this->card = $this->cardDiamond[$this->number - 1];
        } elseif ($this->family === 'Clover') {
            $this->card = $this->cardClover[$this->number - 1];
        }

        return $this->card;
    }
}
