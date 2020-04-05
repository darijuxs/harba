<?php

namespace App\Service\Weather\Provider\Yahoo;

use App\Entity\Request\WeatherRequest;
use App\Entity\Response\WeatherResponse;
use App\Entity\WeatherProvider;
use App\Service\Weather\Provider\ConfigInterface;
use App\Service\Weather\Provider\Exception\InvalidConfigException;
use App\Service\Weather\Provider\Exception\InvalidResponseException;
use App\Service\Weather\Provider\ProviderAbstract;
use App\Service\Weather\WeatherProviderInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

/**
 * Class Client.
 */
class Client extends ProviderAbstract
{
    private const KEY = 'yahoo';

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
            ->setAppId($config['appId'])
            ->setConsumerKey($config['consumerKey'])
            ->setConsumerSecret($config['consumerSecret']);

        return $this;
    }

    /**
     * @param WeatherRequest $weatherRequestRequest
     *
     * @return WeatherResponse
     *
     * @throws InvalidResponseException
     */
    public function getWeather(WeatherRequest $weatherRequestRequest): WeatherResponse
    {
        $data = $this->getWeatherRawData($weatherRequestRequest);

        return (new WeatherResponse())
            ->setProviderName($this->getConfig()->getName())
            ->setTemperature($data['current_observation']['condition']['temperature']);
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
            $handler = new CurlHandler();
            $stack = HandlerStack::create($handler);

            $middleware = new Oauth1([
                'consumer_key' => $this->getConfig()->getConsumerKey(),
                'consumer_secret' => $this->getConfig()->getConsumerSecret(),
                'token_secret' => '',
                'token' => '',
                'request_method' => Oauth1::REQUEST_METHOD_QUERY,
                'signature_method' => Oauth1::SIGNATURE_METHOD_HMAC,
            ]);
            $stack->push($middleware);

            $responseRaw = $this->getGuzzleClient()->request('GET', $this->getConfig()->getUrl(), [
                'handler' => $stack,
                'auth' => 'oauth',
                'query' => [
                    'lat' => $weatherRequest->getLatitude(),
                    'lon' => $weatherRequest->getLongitude(),
                    'u' => 'c',
                    'format' => 'json',
                ],
                'headers' => [
                    'X-Yahoo-App-Id' => $this->getConfig()->getAppId(),
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
