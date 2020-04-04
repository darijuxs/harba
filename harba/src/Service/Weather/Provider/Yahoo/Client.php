<?php

namespace App\Service\Weather\Provider\Yahoo;

use App\Entity\Request\WeatherRequest;
use App\Entity\Response\WeatherResponse;
use App\Entity\WeatherProvider;
use App\Service\Weather\Provider\ConfigInterface;
use App\Service\Weather\Provider\Exception\InvalidConfigProviderException;
use App\Service\Weather\Provider\ProviderAbstract;

/**
 * Class Client.
 */
class Client extends ProviderAbstract
{
    private const KEY = 'yahoo';

    /**
     * OpenWeatherClient constructor.
     */
    public function __construct()
    {
        $this->createGuzzleClient();
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return self::KEY;
    }

    /**
     * @param WeatherProvider $provider
     *
     * @return ConfigInterface
     *
     * @throws InvalidConfigProviderException
     */
    public function setConfiguration(WeatherProvider $provider): ConfigInterface
    {
        $config = json_decode($provider->getConfig(), true);
        if (null === $config) {
            throw new InvalidConfigProviderException();
        }

        return (new Config())
            ->setUrl($config['url'])
            ->setApiKey($config['apiKey']);
    }

    /**
     * @param WeatherRequest $weatherRequestRequest
     *
     * @return WeatherResponse
     */
    public function getWeather(WeatherRequest $weatherRequestRequest): WeatherResponse
    {
        return (new WeatherResponse())
            ->setTemperature(15);
    }
}
