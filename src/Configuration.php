<?php

namespace Configuration;

use Configuration\Parser\ParserInterface;
use DataObject\DataObjectInterface;
use DataObject\DataObjectTrait;

class Configuration implements DataObjectInterface
{

    use DataObjectTrait;

    /** @var string */
    private $environment;

    /**
     * @param array $paths
     * @param string $environment
     */
    public function __construct(array $paths, $environment = 'development')
    {
        $this->setEnvironment($environment);
        $this->setData(self::parse($paths, $this->getEnvironment()));
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     * @return $this
     */
    public function setEnvironment($environment)
    {
        $this->environment = is_string($environment) ? trim($environment) : null;

        return $this;
    }

    /**
     * @param array $paths
     * @param string $environment
     * @return array
     */
    public static function parse(array $paths, $environment = null)
    {
        $data = [];
        foreach ($paths as $path) {
            $data = array_merge($data, self::parseFile($path, $environment));
        }

        ksort($data);

        return $data;
    }

    /**
     * @param $path
     * @param string $environment
     * @return array
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public static function parseFile($path, $environment = null)
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