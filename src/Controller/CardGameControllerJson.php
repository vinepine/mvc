<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use App\Card\CardHand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardGameControllerJson
{
    #[Route('/api/deck', name: 'api_deck', methods: ['GET'])]
    public function apiDeck(): Response
    {
        $deck = new DeckOfCards();
        $deckList = $deck->getCardList();

        $data = [
            'card-list' => $deckList,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/deck/shuffle', name: 'api_shuffle', methods: ['POST'])]
    public function apiShuffle(
        SessionInterface $session
    ): Response {

        $deck = new DeckOfCards();

        $deck->shuffleDeck();
        $deckList = $deck->getCardList();

        $session->set('deck', $deck);

        $data = [
            'shuffled-deck' => $deckList
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('api/deck/draw/{amount}', name: 'api_draw', defaults: ['amount' => 1], methods: ['POST']) ]
    public function apiDraw(
        Request $request,
        SessionInterface $session,
    ): Response {

        $deck = $session->get('deck');

        if (!$deck) {
            $deck = new DeckOfCards();
        }

        $hand = new CardHand();
        $cardToDraw = (int) $request->request->get('number');

        $hand->takeCard($cardToDraw, $deck);
        $handCardList = $hand->getHand();
        $cardsLeft = $deck->cardsLeft();

        $session->set('deck', $deck);

        $data = [
            'hand-cards' => $handCardList,
            'cards-left' => $cardsLeft

        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }

}
