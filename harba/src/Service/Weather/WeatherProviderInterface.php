<?php

namespace App\Service\Weather;

use App\Entity\Request\WeatherRequest;
use App\Entity\Response\WeatherResponse;
use App\Entity\WeatherProvider;
use App\Service\Weather\Provider\ConfigInterface;

/**
 * Interface WeatherProviderInterface.
 */
interface WeatherProviderInterface
{
    /**
     * @return string
     */
    public function getKey(): string;

    /**
     * @param WeatherRequest $weatherRequestRequest
     *
     * @return WeatherResponse
     */
    public function getWeather(WeatherRequest $weatherRequestRequest): WeatherResponse;

    /**
     * @param WeatherProvider $weatherProvider
     *
     * @return WeatherProviderInterface
     */
    public function setConfig(WeatherProvider $weatherProvider): WeatherProviderInterface;

    /**
     * @return ConfigInterface
     */
    public function getConfig(): ConfigInterface;
}
