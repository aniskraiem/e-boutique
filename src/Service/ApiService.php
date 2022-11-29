<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class ApiService 
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client->withOptions([
            
            'headers' => ['X-api-key' => 'PMAK-62642462da39cd50e9ab4ea7-815e244f4fdea2d2075d8966cac3b7f10b']
            
        ]);
    }

    public function getOrders(): array
    {
        return $this->getApi('orders');
    }

    public function orders_to_csv()
    {
        return $this->getApi('orders');
    }
    public function getContacts()
    {
        return $this->getApi('contacts');
    }
    private function getApi(string $var)
    {
        $response = $this->client->request(
            'GET',
            'https://4ebb0152-1174-42f0-ba9b-4d6a69cf93be.mock.pstmn.io/' . $var
        );

        return $response->ToArray();
    }


}