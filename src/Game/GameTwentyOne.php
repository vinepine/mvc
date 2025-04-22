<?php

namespace App\Game;
use App\Card\DeckOfCards;
use App\Game\Player;

class GameTwentyOne {

    private DeckOfCards $deck;
    private Player $playerOne;
    private Player $playerTwo;


    public bool $gameOver;

    public function __construct() 
    {
        $this->deck = new DeckOfCards();
        $this->deck->shuffleDeck();
        $this->playerOne = new Player();
        $this->playerTwo = new Player();

        $this->gameOver = False;
    }

    public function bankAI() {
        while ( $this->playerTwo->getScore() < 17 ) {
            $this->playerTwo->drawOne($this->deck);
        }
    }

    public function draw(int $number) {
        if ( $number == 1 ) {
            $this->playerOne->drawOne($this->deck);
        }

        if ( $number == 2 ) {
            $this->playerTwo->drawOne($this->deck);
        }
    }

    public function getPlayerHand(int $number) {
        if ($number == 1) {

            $cardList = [];
            foreach ($this->playerOne->getPlayerHand() as $card) {
                $cardList[] = $card->toString();
            }

            return $cardList;
        }

        $cardList = [];
        foreach ($this->playerTwo->getPlayerHand() as $card) {
            $cardList[] = $card->toString();
        }
        return $cardList;
    }

    public function decideWinner() {
        $playerOneScore = $this->playerOne->getScore();
        $playerTwoScore = $this->playerTwo->getScore();

        if ( $playerOneScore > 21 ) {
            $winner = 'Bank won';
            $this->gameOver = True;
        } elseif ( $playerOneScore < $playerTwoScore and $playerTwoScore < 22){
            $winner = 'Bank won';
            $this->gameOver = True;
        } elseif ( $playerOneScore == $playerTwoScore ){
            $winner = 'Bank won';
            $this->gameOver = True;
        } else {
            $winner = 'Player 1 won';
            $this->gameOver = True;
        }
        
        return $winner;
    }
    public function isOver() {
        return $this->gameOver;
    }
    public function gameScore() {
        return [$this->playerOne->getScore(), $this->playerTwo->getScore()];
    }
    
    public function getDeck(){
        return $this->deck;
    }
}