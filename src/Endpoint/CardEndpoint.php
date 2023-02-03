<?php

namespace App\Endpoint;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CardEndpoint
{
    const URI = 'https://api.magicthegathering.io/v1/cards';

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getCardList(string $color = null, string $q = null): ResponseInterface
    {
        if (!is_null($color)) {
            $response = $this->client->request(
                'GET',
                self::URI . '?colorIdentity=' . $color,
            );
        } elseif (!is_null($q)) {
            $response = $this->client->request(
                'GET',
                self::URI . '?name=' . $q,
            );
        } else {
            $response = $this->client->request(
                'GET',
                self::URI,
            );
    }

        return $response;
    }

    public function getCard(string $id): ResponseInterface
    {
        $response = $this->client->request(
            'GET',
            self::URI . '/' . $id,
        );

        return $response;
    }

}