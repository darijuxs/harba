<?php

namespace App\Service\Weather\Provider\Exception;

/**
 * Class ProviderNotFoundProviderException.
 */
class ProviderNotFoundProviderException extends ProviderException
{
    /**
     * ProviderNotFoundProviderException constructor.
     */
    public function __construct()
    {
        parent::__construct('Provider not found');
    }
}
