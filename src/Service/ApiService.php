<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;


class ApiService
{

    private $client;

    //connexion à api en utilisant le client http en passant la clé api dans les en-têtes
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client->withOptions([
            'headers' => ['X-api-key' => 'PMAK-62642462da39cd50e9ab4ea7-815e244f4fdea2d2075d8966cac3b7f10b']

        ]);
    }

    //récupérer les données des orders en prend comme route orders qui remplacent la variable var dans la fonction gets API
    public function getOrders(): array
    {
        return $this->getApi('orders');
    }

       //récupérer les données  des contacts en prend comme route orders qui remplacent la variable var dans la fonction gets API

    public function getContacts():array
    {
        return $this->getApi('contacts');
    }

    //récupérer les données de l'api
    private function getApi(string $var)
    {
        $response = $this->client->request(
            'GET',
            'https://internshipapi-pylfsebcoa-ew.a.run.app/' . $var
        );

        return $response->ToArray();
    }


}