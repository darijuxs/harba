<?php

namespace App\Service\Weather;

use App\Entity\Request\WeatherRequest;
use App\Entity\Response\WeatherResponse;
use App\Service\Weather\Provider\Exception\ProviderNotFoundException;
use App\Service\Weather\Provider\Exception\ProviderException;

/**
 * Class WeatherService.
 */
class WeatherService
{
    /**
     * @var WeatherProviderService
     */
    private $weatherProviderService;

    /**
     * WeatherService constructor.
     *
     * @param WeatherProviderService $providerService
     */
    public function __construct(WeatherProviderService $providerService)
    {
        $this->weatherProviderService = $providerService;
    }

    /**
     * @param WeatherRequest $weatherRequest
     *
     * @return WeatherResponse
     *
     * @throws ProviderException
     */
    public function getWeatherByCordinates(WeatherRequest $weatherRequest): WeatherResponse
    {
        $providersIterator = $this->weatherProviderService->getProviders();
        while ($providersIterator->valid()) {
            $provider = $providersIterator->current();
            try {
                /* @var WeatherProviderInterface $provider */
                $providerEntity = $this->weatherProviderService->getProviderData($provider);
                $provider->setConfiguration($providerEntity);

                $response = $provider->getWeather($weatherRequest);

                return $response;
            } catch (ProviderException $exception) {
                $providersIterator->next();
            }
        }

        throw new ProviderNotFoundException();
    }
}
