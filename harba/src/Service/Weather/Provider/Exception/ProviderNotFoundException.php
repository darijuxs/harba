<?php

namespace App\Service\Weather\Provider\Exception;

/**
 * Class ProviderNotFoundException.
 */
class ProviderNotFoundException extends ProviderException
{
    /**
     * ProviderNotFoundProviderException constructor.
     */
    public function __construct()
    {
        parent::__construct('Provider not found');
    }
}
