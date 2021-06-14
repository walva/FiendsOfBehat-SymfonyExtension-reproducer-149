<?php


namespace App\Service;


class ForecastHttpClient
{

    public string $current = '34.3';

    public function getCurrentDegreeInCelsius($country): string
    {
        return $this->current;
    }
}