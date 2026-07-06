<?php

namespace App\Model\Game;

use App\Model\Card\DeckOfCards;
use App\Model\Game\Player;

class GameTwentyOne
{
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

        $this->gameOver = false;
    }

    public function bankAI(): void
    {
        while ($this->playerTwo->getScore() < 17) {
            $this->playerTwo->drawOne($this->deck);
        }
    }

    public function draw(int $number): void
    {
        if ($number == 1) {
            $this->playerOne->drawOne($this->deck);
        }

        if ($number == 2) {
            $this->playerTwo->drawOne($this->deck);
        }
    }

    /**
     * @return string[]
     */
    public function getPlayerHand(int $number): array
    {
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

    public function decideWinner(): string
    {
        $playerOneScore = $this->playerOne->getScore();
        $playerTwoScore = $this->playerTwo->getScore();

        if ($playerOneScore > 21) {
            $winner = 'Bank won';
            $this->gameOver = true;
            return $winner;
        } elseif ($playerOneScore < $playerTwoScore and $playerTwoScore < 22) {
            $winner = 'Bank won';
            $this->gameOver = true;
            return $winner;
        } elseif ($playerOneScore == $playerTwoScore) {
            $winner = 'Bank won';
            $this->gameOver = true;
            return $winner;
        }
        $winner = 'Player 1 won';
        $this->gameOver = true;


        return $winner;
    }
    public function isOver(): bool
    {
        return $this->gameOver;
    }

    /**
     * @return int[]
     */
    public function gameScore(): array
    {
        return [$this->playerOne->getScore(), $this->playerTwo->getScore()];
    }

    public function getDeck(): DeckOfCards
    {
        return $this->deck;
    }
}
