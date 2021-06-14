<?php


namespace App\Tests\Behat;


use App\Service\ForecastHttpClient;
use Behat\Behat\Context\Context;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ForecastContext implements Context
{
    public function __construct(
        protected ContainerInterface $driverContainer,
    )
    {
    }

    /**
     * @Given I force the degreeInCelsius to :value
     */
    public function iForceTheDegreeincelsiusTo($value)
    {
        $client = $this->driverContainer->get(ForecastHttpClient::class);
        $client->current = $value;
    }

}