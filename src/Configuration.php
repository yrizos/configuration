<?php

namespace Configuration;

use Configuration\Parser\ParserInterface;
use DataObject\DataObjectInterface;
use DataObject\DataObjectTrait;

class Configuration implements DataObjectInterface
{

    use DataObjectTrait;

    private $environment;

    public function __construct(array $paths, $environment = 'development')
    {
        $this->setEnvironment($environment);
        $this->setData(self::parse($paths, $this->getEnvironment()));
    }

    public function getEnvironment()
    {
        return $this->environment;
    }

    public function setEnvironment($environment)
    {
        $this->environment = empty($environment) ? false : trim(strval($environment));

        return $this;
    }

    public static function parse(array $paths, $environment = false)
    {
        $data = [];
        foreach ($paths as $path) {
            $data = array_merge($data, self::parseFile($path, $environment));
        }

        ksort($data);

        return $data;
    }

    public static function parseFile($path, $environment = false)
    {
        if (!is_file($path) || !is_readable($path)) throw new \InvalidArgumentException('Path' . $path . ' is invalid.');

        $info = pathinfo($path);
        $ext  = $info['extension'];

        $parser = ucfirst(strtolower($ext));
        if ($parser == 'Yml') $parser = 'Yaml';

        $class = "Configuration\\Parser\\" . ucfirst(strtolower(trim(strval($parser))));

        if (
            !class_exists($class)
            || !in_array("Configuration\\ParserInterface", class_implements($class))
        ) throw new \RuntimeException('Parser ' . $parser . ' doesn\'t exist.');

        $parser = new $class($path);
        $data   = $parser->getData();

        if (!$environment) return $data;

        $path = $info['dirname'] . DIRECTORY_SEPARATOR . $info['filename'] . '.' . $environment . '.' . $info['extension'];
        if (!is_file($path) || !is_readable($path)) return $data;

        $parser->setPath($path);
        $data = array_merge($data, $parser->getData());

        return $data;
    }
}