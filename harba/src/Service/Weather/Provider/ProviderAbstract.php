<?php

namespace App\Service\Weather\Provider;

use GuzzleHttp\Client;
use App\Service\Weather\WeatherProviderInterface;

/**
 * Class ProviderAbstract.
 */
abstract class ProviderAbstract implements WeatherProviderInterface
{
    /**
     * @var Client
     */
    protected $guzzleClient;

    /**
     * @return Client
     */
    public function createGuzzleClient(): Client
    {
        $this->guzzleClient = new Client();

        return $this->guzzleClient;
    }
}
