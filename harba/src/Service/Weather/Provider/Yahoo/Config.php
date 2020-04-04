<?php

namespace App\Service\Weather\Provider\Yahoo;

use App\Service\Weather\Provider\ConfigInterface;

/**
 * Class Config.
 */
class Config implements ConfigInterface
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Config
     */
    public function setUrl(string $url): Config
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     *
     * @return Config
     */
    public function setApiKey(string $apiKey): Config
    {
        $this->apiKey = $apiKey;

        return $this;
    }
}
