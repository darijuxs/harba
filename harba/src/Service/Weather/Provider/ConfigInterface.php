<?php

namespace App\Service\Weather\Provider;

/**
 * Interface ConfigInterface.
 */
interface ConfigInterface
{
    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @return string
     */
    public function getName(): string;
}
