<?php

namespace Configuration;

use Bucket\Container\MagicArrayContainerTrait;

trait ConfigurationTrait
{
    use MagicArrayContainerTrait;

    private $environment;

    public function setEnvironment($environment)
    {
        $this->environment = $environment;

        return $this;
    }

    public function getEnvironment()
    {
        return $this->environment;
    }

} 