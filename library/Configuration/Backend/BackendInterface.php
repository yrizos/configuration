<?php

namespace Configuration\Backend;

use Bucket\Container\MagicArrayContainerInterface;

interface BackendInterface extends MagicArrayContainerInterface
{
    public function setEnvironment($environment);

    public function getEnvironment();
}