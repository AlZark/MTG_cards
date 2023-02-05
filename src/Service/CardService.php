<?php

namespace App\Service;

use App\Endpoint\CardEndpoint;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CardService
{
    private $client;
    private $endpoint;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->endpoint = new CardEndpoint($this->client);
    }
    public function getAllCards($color, $q)
    {
        return $this->endpoint->getCardList($color, $q);
    }

    public function getCardsById($id)
    {
        return $this->endpoint->getCard($id);
    }


}