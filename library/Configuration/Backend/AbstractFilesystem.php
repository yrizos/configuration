<?php

namespace Configuration\Backend;

use Configuration\Configuration;

abstract class AbstractFilesystem extends AbstractBackend implements FilesystemInterface
{
    private $paths = array();

    final public function load()
    {
        $paths = $this->getPaths();

        foreach ($paths as $path) {
            if (!file_exists($path)) throw new \RuntimeException("File doesn't exist.");

            $result = $this->parseFile($path);

            if (!is_array($result)) throw new \RuntimeException("File {$path} couldn't be parsed.");

            $this->setData($result);
        }

        return $this;
    }

    abstract protected function parseFile($path);

    final public function __construct($environment = Configuration::DEFAULT_ENVIRONMENT)
    {
        $this->setEnvironment($environment);
    }

    final public function addPath($path)
    {
        if (!file_exists($path)) throw new \InvalidArgumentException("File doesn't exist.");

        $path    = realpath($path);
        $envPath = $this->getEnvironmentPath($path);

        if (!in_array($path, $this->paths)) $this->paths[] = $path;
        if ($envPath && !in_array($envPath, $this->paths)) $this->paths[] = $envPath;

        return $this;
    }

    protected function getEnvironmentPath($path)
    {
        $env = $this->getEnvironment();
        if (empty($env)) return false;

        $path   = explode(".", $path);
        $ext    = array_pop($path);
        $path[] = $env;
        $path[] = $ext;
        $path   = implode(".", $path);

        return
            file_exists($path)
                ? realpath($path)
                : false;
    }

    final public function getPaths()
    {
        return $this->paths;
    }

} 