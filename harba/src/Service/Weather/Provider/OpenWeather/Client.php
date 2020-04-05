<?php

namespace App\Service\Weather\Provider\OpenWeather;

use App\Entity\WeatherProvider;
use App\Entity\Response\WeatherResponse as WeatherResponse;
use App\Entity\Request\WeatherRequest as WeatherRequest;
use App\Service\Weather\Provider\ConfigInterface;
use App\Service\Weather\Provider\Exception\InvalidConfigException;
use App\Service\Weather\Provider\Exception\InvalidResponseException;
use App\Service\Weather\Provider\ProviderAbstract;
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
     * Client constructor.
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
     * @throws InvalidConfigException
     */
    public function setConfiguration(WeatherProvider $provider): ConfigInterface
    {
        $config = json_decode($provider->getConfig(), true);
        if (null === $config) {
            throw new InvalidConfigException();
        }

        $this->config = (new Config())
            ->setName($provider->getName())
            ->setUrl($config['url'])
            ->setApiKey($config['apiKey']);

        return $this->config;
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
            ->setProviderName($this->config->getName())
            ->setTemperature($data['main']['temp']);
    }

    /**
     * @param WeatherRequest $weatherRequest
     *
     * @return array
     *
     * @throws InvalidResponseException
     */
    private function getWeatherRawData(WeatherRequest $weatherRequest): array
    {
        try {
            $responseRaw = $this->guzzleClient->request('GET', $this->config->getUrl(), [
                'query' => [
                    'appid' => $this->config->getApiKey(),
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
