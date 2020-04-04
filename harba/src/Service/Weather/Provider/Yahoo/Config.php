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
    private $name;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $appId;

    /**
     * @var string
     */
    private $consumerKey;

    /**
     * @var string
     */
    private $consumerSecret;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Config
     */
    public function setName(string $name): Config
    {
        $this->name = $name;

        return $this;
    }

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
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @param string $appId
     *
     * @return Config
     */
    public function setAppId(string $appId): Config
    {
        $this->appId = $appId;

        return $this;
    }

    /**
     * @return string
     */
    public function getConsumerKey(): string
    {
        return $this->consumerKey;
    }

    /**
     * @param string $consumerKey
     *
     * @return Config
     */
    public function setConsumerKey(string $consumerKey): Config
    {
        $this->consumerKey = $consumerKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getConsumerSecret(): string
    {
        return $this->consumerSecret;
    }

    /**
     * @param string $consumerSecret
     *
     * @return Config
     */
    public function setConsumerSecret(string $consumerSecret): Config
    {
        $this->consumerSecret = $consumerSecret;

        return $this;
    }
}
