<?php

namespace App\Controller;

use App\Model\Game\GameTwentyOne;
use App\Model\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GameController extends AbstractController
{
    #[Route('game/', name: 'game')]
    public function startPage(): Response
    {
        return $this->render('game/game.html.twig');
    }


    #[Route('game/start', name: 'game_start')]
    public function gameStart(
        sessionInterface $session
    ): Response {
        if (!$session->get('next')) {
            $session->set('next', 1);
        }
        $next = $session->get('next');

        $game = $session->get('game');
        if (!$game) {
            $game = new GameTwentyOne();
        }

        $scoreArray = $game->gameScore();

        $winner = "";
        if ($next == 2 or $scoreArray[0] > 21) {
            $game->bankAI();
            $scoreArray = $game->gameScore();
            $winner = $game->decideWinner();
        }

        $playerHandOne = $game->getPlayerHand(1);
        $playerHandTwo = $game->getPlayerHand(2);
        $gameOver = $game->isOver();

        $data = [
            'currentScore' => $scoreArray,
            'playerHandOne' => $playerHandOne,
            'playerHandTwo' => $playerHandTwo,
            'next' => $next,
            'winner' => $winner,
            'gameOver' => $gameOver
        ];

        return $this->render('game/gamestart.html.twig', $data);
    }

    #[Route('game/doc', name: 'game_doc')]
    public function gameDocumentation(): Response
    {
        return $this->render('game/doc.html.twig');
    }

    #[Route('game/draw/', name: 'game_draw', methods: ['POST'])]
    public function gameDraw(
        sessionInterface $session,
        Request $request
    ): Response {
        $game = $session->get('game');

        if (!$game) {
            $game = new GameTwentyOne();
        }

        $playerToDraw = (int) $request->request->get('player');

        $game->draw($playerToDraw);

        $session->set('game', $game);

        return $this->redirectToRoute('game_start');
    }

    #[Route('game/done', name: 'game_done', methods: ['POST'])]
    public function gameDone(
        sessionInterface $session,
    ): Response {

        $session->set('next', 2);

        return $this->redirectToRoute('game_start');
    }



    #[Route('game/restart', name: 'game_restart')]
    public function gameRestart(
        sessionInterface $session
    ): Response {
        $session->clear();

        return $this->redirectToRoute('game_start');
    }

}
