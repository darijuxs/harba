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
    private $name;

    /**
     * @var float
     */
    private $temperature;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return WeatherResponse
     */
    public function setName(string $name): WeatherResponse
    {
        $this->name = $name;

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
