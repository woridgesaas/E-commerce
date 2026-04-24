<?php

namespace App\Infrastructure\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class StrapiService
{
    private HttpClientInterface $client;
    private string $baseUrl;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->baseUrl = $_ENV['STRAPI_BASE_URL'];
    }

    /**
     * 🔹 Récupérer toutes les documentations publiées
     */
    public function getAllDocumentations(): array
    {
        $query = http_build_query([
            'filters' => [
                'isPublishedToPublic' => [
                    '$eq' => true
                ]
            ],
            'populate' => '*'
        ]);

        $url = $this->baseUrl . "/api/product-documentations?" . $query;

        try {
            $response = $this->client->request('GET', $url);
            $data = $response->toArray();

            return $data['data'] ?? [];
        } catch (\Exception $e) {
            dump($e->getMessage());
            return [];
        }
    }

    /**
     * 🔹 Récupérer documentation par ID
     */
    public function getDocumentationById(int $id): ?array
    {
        $url = $this->baseUrl . "/api/product-documentations/" . $id . "?populate=*";

        try {
            $response = $this->client->request('GET', $url);
            $data = $response->toArray();

            return $data['data'] ?? null;
        } catch (\Exception $e) {
            dump($e->getMessage());
            return null;
        }
    }

    /**
     * 🔥 🔹 Récupérer documentation par productId (TA FONCTION PRINCIPALE)
     */
    public function getDocumentationByProductId(int $productId): array
    {
        $query = http_build_query([
            'filters' => [
                'productId' => [
                    '$eq' => (string) $productId 
                ],
                'isPublishedToPublic' => [
                    '$eq' => true
                ]
            ],
            'populate' => '*'
        ]);

        $url = $this->baseUrl . "/api/product-documentations?" . $query;

        try {
            $response = $this->client->request('GET', $url);
            $data = $response->toArray();

            return $data['data'] ?? [];
        } catch (\Exception $e) {
            dump($e->getMessage());
            return [];
        }
    }
}