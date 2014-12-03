<?php

namespace Configuration\Parser;

use Configuration\Parser;
use Configuration\ParserInterface;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Yaml extends Parser implements ParserInterface
{

    protected function parse($path)
    {
        $input = @file_get_contents($path);
        $input = strval($input);
        if (!empty($input)) $data = @SymfonyYaml::parse($input);

        if (!is_array($data)) throw new \RuntimeException('Parse failed.');

        return $data;
    }
} 