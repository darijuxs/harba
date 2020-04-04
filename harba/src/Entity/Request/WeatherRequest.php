<?php

namespace App\Entity\Request;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Weather.
 */
class WeatherRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("float")
     *
     * @var float
     */
    private $latitude;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("float")
     *
     * @var float
     */
    private $longitude;
    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     *
     * @return WeatherRequest
     */
    public function setLatitude(float $latitude): WeatherRequest
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     *
     * @return WeatherRequest
     */
    public function setLongitude(float $longitude): WeatherRequest
    {
        $this->longitude = $longitude;

        return $this;
    }
}
