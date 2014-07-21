<?php

namespace Configuration;

use Bucket\Container\MagicArrayContainerInterface;

interface ConfigurationInterface extends MagicArrayContainerInterface
{
    const DEFAULT_ENVIRONMENT = "development";

    public function setEnvironment($environment);

    public function getEnvironment();
} 