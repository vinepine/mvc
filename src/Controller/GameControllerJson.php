<?php

namespace App\Controller;

use App\Game\GameTwentyOne;
use App\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class GameControllerJson extends AbstractController {
    #[Route('api/game', name: 'api_game')]
    public function apiGame(
        sessionInterface $session
    ) {

        $game = $session->get('game');
        if (!$game) {
            $game = new GameTwentyOne();
        }

        $playerOne = $game->getPlayerHand(1);
        $playerTwo = $game->getPlayerHand(2);
        $winner = 'No winner';
        if ( $game->isOver() ) {
            $winner = $game->decideWinner();
        };

        $data = [
            'player-one-hand' => $playerOne,
            'player-two-hand' => $playerTwo,
            'game-winner' => $winner
        ];

        $response = new JsonResponse($data);

        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;

    }
}