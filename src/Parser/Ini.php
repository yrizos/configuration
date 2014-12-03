<?php

namespace Configuration\Parser;

use Configuration\Parser;
use Configuration\ParserInterface;

class Ini extends Parser implements ParserInterface
{

    protected function parse($path)
    {
        $input = @file_get_contents($path);
        $input = strval($input);
        if (!empty($input)) $data = @parse_ini_string($input, true);

        if (!is_array($data)) throw new \RuntimeException('Parse failed.');

        return $data;
    }

} 