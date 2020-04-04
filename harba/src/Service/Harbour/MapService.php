<?php

namespace App\Service\Harbour;

use App\Entity\Response\HarborResponse;
use App\Service\Harbour\Exception\InvalidResponseException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class MapService.
 */
class MapService
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var string
     */
    private $harborApiUrl;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * MapService constructor.
     *
     * @param SerializerInterface $serializer
     * @param string              $harborApiUrl
     */
    public function __construct(SerializerInterface $serializer, string $harborApiUrl)
    {
        $this->guzzleClient = new Client();
        $this->harborApiUrl = $harborApiUrl;
        $this->serializer = $serializer;
    }

    /**
     * @return array
     *
     * @throws InvalidResponseException
     */
    public function getHarbours(): array
    {
        $harborsRawData = $this->getHarboursRawData();

        $harbors = $this->serializer->deserialize($harborsRawData, HarborResponse::class.'[]', 'json');

        return $harbors;
    }

    /**
     * @return string
     *
     * @throws InvalidResponseException
     */
    private function getHarboursRawData(): string
    {
        try {
            $responseRaw = $this->guzzleClient->request('GET', $this->harborApiUrl);

            return $responseRaw->getBody();
        } catch (GuzzleException $exception) {
            throw new InvalidResponseException($exception->getMessage());
        }
    }
}
