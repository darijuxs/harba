<?php

namespace App\Service\Weather;

use App\Entity\WeatherProvider;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class WeatherProviderService.
 */
class WeatherProviderService
{
    /**
     * @var WeatherProviderInterface[]|iterable
     */
    private $apiProviders;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * WeatherProviderService constructor.
     *
     * @param iterable               $apiProviders
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(iterable $apiProviders, EntityManagerInterface $entityManager)
    {
        $this->apiProviders = $apiProviders;
        $this->entityManager = $entityManager;
    }

    /**
     * @return WeatherProviderInterface[]|iterable
     */
    public function getProviders(): iterable
    {
        return $this->apiProviders->getIterator();
    }

    /**
     * @param WeatherProviderInterface $weatherProvider
     *
     * @return WeatherProvider
     */
    public function getProviderData(WeatherProviderInterface $weatherProvider): WeatherProvider
    {
        return $this->entityManager
            ->getRepository(WeatherProvider::class)
            ->findOneBy(['key' => $weatherProvider->getKey()]);
    }
}
