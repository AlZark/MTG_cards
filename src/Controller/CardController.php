<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CardController extends AbstractController
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    #[Route('cards/', name: 'app_homepage')]
    public function homepage(Request $request): Response
    {
        $color = $request->query->get('color');
        $q = $request->query->get('q');

        $cards = $this->getCardList($color, $q)->getContent();
        $data = json_decode($cards, true);

        return $this->render('card/homepage.html.twig', [
            'title' => 'MTG Cards',
            'cards' => $data['cards'],
        ]);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    #[Route('cards/{id}', name: 'app_card_details')]
    public function cardDetails($id): Response
    {

        $cards = $this->getCard($id)->getContent();
        $data = json_decode($cards, true);

        return $this->render('card/details.html.twig', [
            'title' => 'MTG Cards',
            'card' => $data['card'],
        ]);
    }

    /**
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getCardList(string $color = null, string $q = null): Response
    {
        if (!is_null($color)) {
            $response = $this->client->request(
                'GET',
                'https://api.magicthegathering.io/v1/cards?colorIdentity=' . $color,
            );
        } elseif (!is_null($q)) {
            $response = $this->client->request(
                'GET',
                'https://api.magicthegathering.io/v1/cards?name=' . $q,
            );
        } else {
            $response = $this->client->request(
                'GET',
                'https://api.magicthegathering.io/v1/cards',
            );
        }

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'

        return $this->json($response->toArray());
    }

    /**
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getCard(string $id): Response
    {
        $response = $this->client->request(
            'GET',
            'https://api.magicthegathering.io/v1/cards/' . $id,
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'

        return $this->json($response->toArray());
    }

}