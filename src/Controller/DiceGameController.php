<?php

namespace App\Controller;

use App\Dice\DiceGraphic;
use App\Dice\DiceHand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DiceGameController extends AbstractController
{
    #[Route("/game/pig", name: "pig_start")]
    public function home(): Response
    {   

        $die = new DiceGraphic();
        $data = [
            "dice" => $die->roll(),
            "diceString" => $die->getAsString(),
        ];

        return $this->render('pig/home.html.twig', $data);
    }

    #[Route("/game/pig/init", name: "pig_init_get", methods: ['GET'])]
    public function init(): Response
    {
        return $this->render('pig/init.html.twig');
    }

    #[Route("/game/pig/init", name: "pig_init_post", methods: ['POST'])]
    public function initCallback(
        Request $request,
        SessionInterface $session
    ): Response
    {
        $numDice = $request->request->get('num_dices');

        

        $hand = new DiceHand();
        for ( $i=0; $i < $numDice; $i++ ) {
            $hand->add(new DiceGraphic() );
        }
        $hand->roll();

        $session->set("pig_dicehand", $hand);
        $session->set('pig_dices', $numDice);
        $session->set('pig_round', 0);
        $session->set('pig_total', 0);
        
        return $this->redirectToRoute('pig_play');
    }

    #[Route("/game/pig/play", name: "pig_play", methods: ['GET'])]
    public function play(
        SessionInterface $session
    ): Response
    {   
        $dicehand = $session->get('pig_dicehand');

        $data = [
            'pigDices' => $session->get('pig_dices'),
            'pigRound' => $session->get('pig_round'),
            'pigTotal' => $session->get('pig_total'),
            'diceValues' => $dicehand->getString(),
        ];

        return $this->render('pig/play.html.twig', $data);
    }

    #[Route("/game/pig/roll", name: "pig_roll", methods: ['POST'])]
    public function roll(
        sessionInterface $session
    ): Response
    {

        $hand = $session->get('pig_dicehand');
        $hand->roll();

        $roundTotal = $session->get('pig_round');
        $round = 0;
        $values = $hand->getValues();
        foreach ($values as $value) {
            if ( $value === 1 ) {
                $round = 0;
                $roundTotal = 0;
                break;
            }
            $round += $value;
        }

        $session->set('pig_round', $roundTotal + $round);

        return $this->redirectToRoute('pig_play');
    }

    #[Route("/game/pig/save", name: "pig_save", methods: ['POST'])]
    public function save(
        sessionInterface $session
    ): Response
    {
        
        $total = $session->get('pig_total');
        $roundTotal = $session->get('pig_round');


        $session->set('pig_round', 0);
        $session->set('pig_total', $total + $roundTotal);


        return $this->redirectToRoute('pig_play');
    }
}