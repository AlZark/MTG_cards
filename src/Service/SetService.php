<?php

namespace App\Service;

use App\Endpoint\SetEndpoint;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SetService
{
    private $client;
    private $endpoint;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->endpoint = new SetEndpoint($this->client);
    }

    public function getAllSets($q)
    {
        return $this->endpoint->getSetList($q);
    }
}