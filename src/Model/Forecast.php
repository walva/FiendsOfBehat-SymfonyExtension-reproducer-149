<?php

namespace App\Model;


use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;

#[ApiResource(
    collectionOperations: ["get"],
    itemOperations: ["get"],
    attributes: [
        'pagination_enabled' => false
    ]
)]
class Forecast
{

    #[ApiProperty(identifier: true)]
    public ?string $identifier = null;

    public function __construct(
        int $identifier,
        public string $degreeInCelsius
    )
    {
        $this->identifier = $identifier;
    }
}