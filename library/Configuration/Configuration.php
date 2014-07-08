<?php

namespace Configuration;

use Configuration\Backend\Ini;
use Configuration\Backend\Json;
use Configuration\Backend\PhpArray;

class Configuration
{
    const DEFAULT_ENVIRONMENT = "development";

    public static function ini($path, $environment = self::DEFAULT_ENVIRONMENT)
    {
        $configuration = new Ini($environment);

        return $configuration->addPath($path)->load();
    }

    public static function phpArray($path, $environment = self::DEFAULT_ENVIRONMENT)
    {
        $configuration = new PhpArray($environment);

        return $configuration->addPath($path)->load();
    }

    public static function json($path, $environment = self::DEFAULT_ENVIRONMENT)
    {
        $configuration = new Json($environment);

        return $configuration->addPath($path)->load();
    }

    public static function file($path, $environment = self::DEFAULT_ENVIRONMENT)
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