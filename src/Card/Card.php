<?php

namespace App\Card;

class Card {
    public $number;
    public $family;
    private $card;

    public function __construct($number, $family){
        $this->number = $number;
        $this->family = $family;

        $this->cardSpade = ['🂡', '🂢', '🂣', '🂤', '🂥', '🂦', '🂧', '🂨', '🂩', '🂪', '🂫', '🂬', '🂭', '🂮'];
        $this->cardHeart = ['🂱', '🂲', '🂳', '🂴', '🂵', '🂶', '🂷', '🂸', '🂹', '🂺', '🂻', '🂼', '🂽', '🂾'];
        $this->cardDiamond = ['🃁', '🃂', '🃃', '🃄', '🃅', '🃆', '🃇', '🃈', '🃉', '🃊', '🃋', '🃌', '🃍', '🃎'];
        $this->cardClover = ['🃑', '🃒', '🃓', '🃔', '🃕', '🃖', '🃗', '🃘', '🃙', '🃚', '🃛', '🃜', '🃝', '🃞'];
    }

    public function toString() {
        if ( $this->family === 'Hearts' ) {
            $this->card = $this->cardHeart[$this->number - 1];
        } elseif ( $this->family === 'Spade' ) {
            $this->card = $this->cardSpade[$this->number - 1];
        } elseif ( $this->family === 'Diamond' ) {
            $this->card = $this->cardDiamond[$this->number - 1];
        } elseif ( $this->family === 'Clover' ) {
            $this->card = $this->cardClover[$this->number - 1];
        }

        return $this->card;
    }
}

#$card = new Card(1, 'Hearts');

#echo $card->toString();

#🂡	🂢	🂣	🂤	🂥	🂦	🂧	🂨	🂩	🂪	🂫	🂬	🂭	🂮
#🂱	🂲	🂳	🂴	🂵	🂶	🂷	🂸	🂹	🂺	🂻	🂼	🂽	🂾	
#🃁	🃂	🃃	🃄	🃅	🃆	🃇	🃈	🃉	🃊	🃋	🃌	🃍	🃎	
#🃑	🃒	🃓	🃔	🃕	🃖	🃗	🃘	🃙	🃚	🃛	🃜	🃝	🃞	
