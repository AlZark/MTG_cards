<?php

namespace App\Controller;

use App\Service\CardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CardController extends AbstractController
{

    #[Route('cards/', name: 'cards')]
    public function getCards(Request $request, CardService $service): Response
    {
        $color = $request->query->get('color');
        $q = $request->query->get('q');

        $cards = $this->json($service->getAllCards($color, $q)->toArray())->getContent();

        $data = json_decode($cards, true);

        return $this->render('card/list.html.twig', [
            'title' => 'MTG Cards',
            'cards' => $data['cards'],
        ]);
    }

    #[Route('cards/{id}', name: 'card_view')]
    public function cardDetails($id, CardService $service): Response
    {
        $card = $this->json($service->getCardsById($id)->toArray())->getContent();

        $data = json_decode($card, true);

        return $this->render('card/view.html.twig', [
            'title' => 'MTG Cards',
            'card' => $data['card'],
        ]);
    }

}