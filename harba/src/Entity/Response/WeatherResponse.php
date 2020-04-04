<?php

namespace App\Entity\Response;

/**
 * Class WeatherResponse.
 */
class WeatherResponse
{
    /**
     * @var int
     */
    private $temperature;

    /**
     * @return int
     */
    public function getTemperature(): int
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
