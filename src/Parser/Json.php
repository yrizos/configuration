<?php

namespace Configuration\Parser;

use Configuration\Parser;
use Configuration\ParserInterface;

class Json extends Parser implements ParserInterface
{

    protected function parse($path)
    {
        $input = @file_get_contents($path);
        $input = strval($input);
        if (!empty($input)) $data = @json_decode($input, true);

        if (!is_array($data)) throw new \RuntimeException('Parse failed.');

        return $data;
    }

} 