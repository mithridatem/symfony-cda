<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final class MemeApiService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient
    ) {}

    public function getMemes(): array
    {
        //Récupérer la réponse de la BDD
        $response = $this->httpClient->request(
            'GET',
            'https://api.imgflip.com/get_memes'
        );

        return $response->toArray(true);
    }
}
