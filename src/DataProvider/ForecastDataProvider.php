<?php

namespace App\DataProvider;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Model\Forecast;
use App\Service\ForecastHttpClient;


class ForecastDataProvider implements ItemDataProviderInterface, ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(public ForecastHttpClient $client)
    {
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Forecast::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        return [
            new Forecast('BE', $this->client->getCurrentDegreeInCelsius('BE'))
        ];
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Forecast
    {
        // Retrieve the blog post item from somewhere then return it or null if not found
        return new Forecast($id, $this->client->getCurrentDegreeInCelsius($id));
    }
}