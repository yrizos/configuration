<?php

namespace Configuration\Filesystem;

use Configuration\ConfigurationTrait;

abstract class AbstractFilesystem implements FilesystemInterface
{
    use ConfigurationTrait;

    private $paths = [];

    abstract public function parseFile($path);

    public function addPath($path)
    {
        if (!file_exists($path)) throw new \InvalidArgumentException();

        $paths = [realpath($path), $this->getEnvironmentPath($path)];

        foreach ($paths as $path) {
            if (isset($this->paths[$path])) continue;

            $conf = $this->parseFile($path);

            if (is_array($conf)) {
                $this->paths[] = $path;
                $this->merge($conf);
            }
        }

        return $this;
    }

    public function getPaths()
    {
        return $this->paths;
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

} 