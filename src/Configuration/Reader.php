<?php

namespace Configuration;

use Configuration\Filesystem\Ini;
use Configuration\Filesystem\Json;
use Configuration\Filesystem\PhpArray;

class Reader
{

    public static function ini($path, $environment = ConfigurationInterface::DEFAULT_ENVIRONMENT)
    {
        $configuration = new Ini($environment);

        return $configuration->setEnvironment($environment)->addPath($path);
    }

    public static function phpArray($path, $environment = ConfigurationInterface::DEFAULT_ENVIRONMENT)
    {
        $configuration = new PhpArray($environment);

        return $configuration->setEnvironment($environment)->addPath($path);
    }

    public static function json($path, $environment = ConfigurationInterface::DEFAULT_ENVIRONMENT)
    {
        $configuration = new Json($environment);

        return $configuration->setEnvironment($environment)->addPath($path);
    }

    public static function file($path, $environment = ConfigurationInterface::DEFAULT_ENVIRONMENT)
    {
        $temp = explode(".", $path);
        $ext  = array_pop($temp);
        $ext  = strtolower($ext);

        if ($ext == "ini") return self::ini($path, $environment);
        if ($ext == "php") return self::phpArray($path, $environment);
        if ($ext == "json") return self::json($path, $environment);

        throw new \InvalidArgumentException("Can't guess file format.");
    }
} 