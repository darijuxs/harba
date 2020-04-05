<?php

namespace App\Tests;

use App\Entity\Request\WeatherRequest;
use App\Entity\Response\WeatherResponse;
use App\Service\Weather\Provider\Exception\InvalidResponseException;
use App\Service\Weather\Provider\OpenWeather\Client;
use App\Service\Weather\Provider\OpenWeather\Config;
use App\Service\Weather\WeatherProviderInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use PHPUnit\Framework\TestCase;

/**
 * Class OpenWeatherClientTest.
 */
class OpenWeatherClientTest extends TestCase
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var WeatherRequest
     */
    private $weatherRequest;

    /**
     * Set up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->config = (new Config())
            ->setName('OpenWeather')
            ->setUrl('http://api.openweathermap.org/data/2.5/weather')
            ->setApiKey('api_key');

        $this->weatherRequest = (new WeatherRequest())
            ->setLatitude(23.96)
            ->setLongitude(53.25);
    }

    public function testClientInterface()
    {
        $client = new Client();
        $this->assertInstanceOf(WeatherProviderInterface::class, $client);
    }

    public function testWeatherResponse()
    {
        /* @var Client $clientMock */
        $clientMock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['getWeatherRawData', 'getConfig'])
            ->getMock();

        $clientMock->method('getWeatherRawData')->willReturn(
            [
                'main' => [
                    'temp' => 14.02,
                ],
            ]
        );

        $clientMock->method('getConfig')->willReturn(
            (new Config())
                ->setName('OpenWeather')
        );

        $weatherResponse = $clientMock->getWeather($this->weatherRequest);

        $this->assertEquals($weatherResponse, (new WeatherResponse())
            ->setProviderName('OpenWeather')
            ->setTemperature(14.02)
        );
    }

    public function testWeathherRawData()
    {
        /* @var Client $clientMock */
        $clientMock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['getGuzzleClient', 'getConfig'])
            ->getMock();

        /* @var GuzzleClient $mock */
        $guzzleClientMock = $this->getMockBuilder(GuzzleClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $guzzleResponseMock = $this->getMockBuilder(GuzzleResponse::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBody'])
            ->getMock();

        $guzzleResponseMock->method('getBody')->willReturn('{"main":{"temp":9.57,"feels_like":4.98,"temp_min":9,"temp_max":10,"pressure":1033,"humidity":49}}');
        $guzzleClientMock->method('request')->willReturn($guzzleResponseMock);
        $clientMock->method('getGuzzleClient')->willReturn($guzzleClientMock);
        $clientMock->method('getConfig')->willReturn($this->config);

        $weatherResponse = $clientMock->getWeatherRawData($this->weatherRequest);

        $this->assertEquals($weatherResponse, [
            'main' => [
                'temp' => 9.57,
                'feels_like' => 4.98,
                'temp_min' => 9,
                'temp_max' => 10,
                'pressure' => 1033,
                'humidity' => 49,
            ],
        ]);
    }

    public function testWeathherRawDataException()
    {
        /* @var Client $cleintMock */
        $cleintMock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['getGuzzleClient', 'getConfig'])
            ->getMock();

        /* @var GuzzleClient $mock */
        $guzzleClientMock = $this->getMockBuilder(GuzzleClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $guzzleResponseMock = $this->getMockBuilder(GuzzleResponse::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBody'])
            ->getMock();

        $guzzleResponseMock->method('getBody')->willReturn('');
        $guzzleClientMock->method('request')->willReturn($guzzleResponseMock);
        $cleintMock->method('getGuzzleClient')->willReturn($guzzleClientMock);
        $cleintMock->method('getConfig')->willReturn($this->config);

        $this->expectException(InvalidResponseException::class);

        $cleintMock->getWeatherRawData($this->weatherRequest);
    }
}
