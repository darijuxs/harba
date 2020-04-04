<?php

namespace App\Service\Weather\Provider\Exception;

/**
 * Class InvalidConfigProviderException.
 */
class InvalidConfigProviderException extends ProviderException
{
    /**
     * InvalidConfigProviderException constructor.
     */
    public function __construct()
    {
        parent::__construct('Invalid configuration');
    }
}
