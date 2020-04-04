<?php

namespace App\Service\Weather\Provider\Exception;

/**
 * Class InvalidConfigException.
 */
class InvalidConfigException extends ProviderException
{
    /**
     * InvalidConfigProviderException constructor.
     */
    public function __construct()
    {
        parent::__construct('Invalid configuration');
    }
}
