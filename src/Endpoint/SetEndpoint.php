<?php

namespace App\Endpoint;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class SetEndpoint
{
    const URI = 'https://api.magicthegathering.io/v1/sets';

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getSetList($q): ResponseInterface
    {
        $response = $this->client->request(
            'GET',
            isset($q) ? self::URI . '?name=' . $q : self::URI,
        );

        return $response;
    }
}