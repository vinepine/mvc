<?php

namespace App\Card;

use App\Card\Card;

class CardGraphic extends Card
{
    /** @var string[] */
    private array $cardSpade;
    /** @var string[] */
    private array $cardHeart;
    /** @var string[] */
    private array $cardDiamond;
    /** @var string[] */
    private array $cardClover;

    private string $card;

    public function __construct(int $number, string $family)
    {
        parent::__construct($number, $family);

        $this->cardSpade = ['🂡', '🂢', '🂣', '🂤', '🂥', '🂦', '🂧', '🂨', '🂩', '🂪', '🂫', '🂭', '🂮'];
        $this->cardHeart = ['🂱', '🂲', '🂳', '🂴', '🂵', '🂶', '🂷', '🂸', '🂹', '🂺', '🂻', '🂽', '🂾'];
        $this->cardDiamond = ['🃁', '🃂', '🃃', '🃄', '🃅', '🃆', '🃇', '🃈', '🃉', '🃊', '🃋', '🃍', '🃎'];
        $this->cardClover = ['🃑', '🃒', '🃓', '🃔', '🃕', '🃖', '🃗', '🃘', '🃙', '🃚', '🃛', '🃝', '🃞'];
    }

    public function toString(): string
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
