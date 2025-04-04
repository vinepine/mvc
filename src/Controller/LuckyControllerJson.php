<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class LuckyControllerJson 
{
    #[Route("/api/lucky/number")]
    public function jsonNumber(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'lucky-number' => $number,
            'lucky-message' => 'Hi there!',
        ];

        return new JsonResponse($data);
    }

    #[Route('/api/quote', name: 'quote')]
    public function quote(): Response
    {
        $number = random_int(0, 2);
        $quotes = ["One must be a wise reader to quote wisely and well.",
        "To refuse awards is another way of accepting them with more noise than is normal.",
        "Time is an illusion. Lunchtime doubly so."];
        $date = date("Y-m-d");
        $timestamp = time();
        $data = [
            'lucky-quote' => $quotes[$number],
            'lucky-date' => $date,
            'lucky-timestamp' => $timestamp
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;

    }
}