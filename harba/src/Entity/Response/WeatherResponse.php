<?php

namespace App\Entity\Response;

/**
 * Class WeatherResponse.
 */
class WeatherResponse
{
    /**
     * @var string
     */
    private $providerName;

    /**
     * @var float
     */
    private $temperature;

    /**
     * @return string
     */
    public function getProviderName(): string
    {
        return $this->providerName;
    }

    /**
     * @param string $providerName
     *
     * @return WeatherResponse
     */
    public function setProviderName(string $providerName): WeatherResponse
    {
        $this->providerName = $providerName;

        return $this;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @param float $temperature
     *
     * @return WeatherResponse
     */
    public function setTemperature(float $temperature): WeatherResponse
    {
        $this->temperature = $temperature;

        return $this;
    }
}
