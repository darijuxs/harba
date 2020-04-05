<?php

namespace App\Service\Weather\Provider\OpenWeather;

use App\Entity\WeatherProvider;
use App\Entity\Response\WeatherResponse as WeatherResponse;
use App\Entity\Request\WeatherRequest as WeatherRequest;
use App\Service\Weather\Provider\ConfigInterface;
use App\Service\Weather\Provider\Exception\InvalidConfigException;
use App\Service\Weather\Provider\Exception\InvalidResponseException;
use App\Service\Weather\Provider\ProviderAbstract;
use App\Service\Weather\WeatherProviderInterface;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Client.
 */
class Client extends ProviderAbstract
{
    private const KEY = 'openweather';

    /**
     * @var Config
     */
    private $config;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return self::KEY;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig(): ConfigInterface
    {
        return $this->config;
    }

    /**
     * @param WeatherProvider $provider
     *
     * @return WeatherProviderInterface
     *
     * @throws InvalidConfigException
     */
    public function setConfig(WeatherProvider $provider): WeatherProviderInterface
    {
        $config = json_decode($provider->getConfig(), true);
        if (null === $config) {
            throw new InvalidConfigException();
        }

        $this->config = (new Config())
            ->setName($provider->getName())
            ->setUrl($config['url'])
            ->setApiKey($config['apiKey']);

        return $this;
    }

    /**
     * @param WeatherRequest $weatherRequest
     *
     * @return WeatherResponse
     *
     * @throws InvalidResponseException
     */
    public function getWeather(WeatherRequest $weatherRequest): WeatherResponse
    {
        $data = $this->getWeatherRawData($weatherRequest);

        return (new WeatherResponse())
            ->setProviderName($this->getConfig()->getName())
            ->setTemperature($data['main']['temp']);
    }

    /**
     * @param WeatherRequest $weatherRequest
     *
     * @return array
     *
     * @throws InvalidResponseException
     */
    public function getWeatherRawData(WeatherRequest $weatherRequest): array
    {
        try {
            $responseRaw = $this->getGuzzleClient()->request('GET', $this->getConfig()->getUrl(), [
                'query' => [
                    'appid' => $this->getConfig()->getApiKey(),
                    'lat' => $weatherRequest->getLatitude(),
                    'lon' => $weatherRequest->getLongitude(),
                    'units' => 'metric',
                ],
            ]);

            $response = json_decode($responseRaw->getBody(), true);
            if (null === $response) {
                throw new InvalidResponseException('Invalid response returned');
            }

            return $response;
        } catch (GuzzleException $exception) {
            throw new InvalidResponseException($exception->getMessage());
        }
    }
}
