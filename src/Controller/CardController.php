<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CardController extends AbstractController
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/')]
    public function homepage(): Response
    {
        $cards = $this->getCardList()->getContent();
        $data = json_decode($cards, true);

        return $this->render('card/homepage.html.twig', [
            'title' => 'MTG Cards',
            'cards' => $data['cards']
        ]);
    }




    #[Route('api/cards', methods: ['GET'])]
    public function getCardList(): Response
    {
        $response = $this->client->request(
            'GET',
            'https://api.magicthegathering.io/v1/cards',
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'

         return $this->json($response->toArray());
    }
}