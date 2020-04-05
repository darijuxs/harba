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
    private $guzzleClient;

    /**
     * ProviderAbstract constructor.
     */
    public function __construct()
    {
        $this->guzzleClient = new Client();
    }

    /**
     * @return Client
     */
    public function getGuzzleClient(): Client
    {
        return $this->guzzleClient;
    }
}
