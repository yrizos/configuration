<?php

namespace Configuration\Backend;

use Bucket\Container\MagicArrayContainer;
use Configuration\Configuration;

abstract class AbstractBackend extends MagicArrayContainer implements BackendInterface
{
    private $environment = Configuration::DEFAULT_ENVIRONMENT;

    abstract function load();

    final public function setEnvironment($environment)
    {
        $this->environment = trim($environment);

        return $this;
    }

    final public function getEnvironment()
    {
        return $this->environment;
    }

} 