<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use App\Card\CardHand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardGameController extends AbstractController
{
    #[Route('/card', name: 'card_land_page')]
    public function cardStartPage(): Response
    {


        return $this->render('card/home.html.twig');
    }

    #[Route('/card/deck', name: 'card_deck')]
    public function renderDeck(
        SessionInterface $session
    ): Response {
        if ($session->get('deck')) {
            $deck = $session->get('deck');
        } else {
            $deck = new DeckOfCards();
        }

        $deckList = $deck->getCardList();

        ksort($deckList);

        $session->set('deck', $deck);
        $data = [
            'cards' => $deckList
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    #[Route('/card/deck/shuffle', name: 'deck_shuffle')]
    public function shuffleCards(
        SessionInterface $session
    ): Response {


        $deck = new DeckOfCards();


        $deck->shuffleDeck();
        $shuffledList = $deck->getCardList();

        $session->set('deck', $deck);
        $data = [
            'cards' => $shuffledList,
        ];

        return $this->render('card/shuffled.html.twig', $data);
    }

    #[Route('/card/deck/draw/{amount}', name: 'draw_one', defaults: ['amount' => 1])]
    public function drawOne(
        SessionInterface $session,
        int $amount
    ): Response {

        if ($session->get('deck')) {
            $deck = $session->get('deck');
            $hand = new CardHand();
        } else {
            $deck = new DeckOfCards();
            $hand = new CardHand();
        }

        $hand->takeCard($amount, $deck);

        $current = $hand->getHand();
        $cardsLeft = $deck->cardsLeft();



        $session->set('deck', $deck);
        $data = [
            'hand' => $current,
            'cardsLeft' => $cardsLeft,
        ];

        return $this->render('card/drawone.html.twig', $data);
    }
}
