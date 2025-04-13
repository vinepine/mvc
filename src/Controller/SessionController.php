<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'session')]
    public function session(SessionInterface $session)
    {

        $session = $session->all();

        $data = [
            'session' => $session,
        ];

        return $this->render('session/session.html.twig', $data);
    }

    #[Route('/session/delete', name: 'delete_session')]
    public function deleteSession(SessionInterface $session)
    {
        $session->clear();

        $this->addFlash('warning', 'Session was deleted');

        return $this->redirectToRoute('session');
    }
}
