<?php

namespace App\Infrastructure\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class StrapiService
{
    private HttpClientInterface $client;
    private string $baseUrl;

    public function __construct(HttpClientInterface $client, string $baseUrl)
    {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
    }

    
   private function request(string $endpoint, array $query = []): array
{
    $url = $this->baseUrl . $endpoint;

    try {
        $response = $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['STRAPI_API_TOKEN']
            ],
            'query' => $query,
        ]);

        return $response->toArray()['data'] ?? [];
    } catch (\Exception $e) {
        dump($e->getMessage());
        return [];
    }
}

    /**
     * 🔹 Toutes les documentations
     */
    public function getAllDocumentations(): array
    {
        return $this->request('/api/product-documentations', [
            'filters' => [
                'isPublishedToPublic' => [
                    '$eq' => true
                ]
            ],
            'populate' => '*'
        ]);
    }

    /**
     * 🔹 Par ID
     */
    public function getDocumentationById(int $id): ?array
    {
        $data = $this->request("/api/product-documentations/$id", [
            'populate' => '*'
        ]);

        return $data ?: null;
    }

    public function getDocumentationByProductId(int $productId): array
{
    return $this->request('/api/product-documentations', [
        'filters' => [
            'productId' => [   
                '$eq' => $productId
            ],
            'isPublishedToPublic' => [
                '$eq' => true
            ]
        ],
        'populate' => '*'
    ]);
}
public function getAllSubscriptions(): array
{
    return $this->request('/api/subscription-documentations', [
        'filters' => [
            'isPublishedToPublic' => [
                '$eq' => true
            ]
        ],
        'populate' => '*'
    ]);
}

public function getSubscriptionByType(string $type): array
{
    return $this->request('/api/subscription-documentations', [
        'filters' => [
            'subscriptionType' => [
                '$eq' => $type
            ],
            'isPublishedToPublic' => [
                '$eq' => true
            ]
        ],
        'populate' => '*'
    ]);
}
}