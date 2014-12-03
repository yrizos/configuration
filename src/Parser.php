<?php

namespace Configuration;

abstract class Parser
{

    private $data = [];
    private $path;

    final public function __construct($path)
    {
        $this->setPath($path);
    }

    final public function setPath($path)
    {
        if (!is_file($path) || !is_readable($path)) throw new \InvalidArgumentException('Path ' . $path . ' is invalid.');

        $this->data = [];
        $this->path = $path;

        return $this;
    }

    final public function getPath()
    {
        return $this->path;
    }

    final public function getData()
    {
        if (!empty($this->data)) return $this->data;

        $data = $this->parse($this->getPath());

        return $this->data = $data;
    }

    abstract protected function parse($path);
} 