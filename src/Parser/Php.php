<?php

namespace Configuration\Parser;

use Configuration\Parser;
use Configuration\ParserInterface;

class Php extends Parser implements ParserInterface
{

    protected function parse($path)
    {
        $data = @ include($path);

        if (!is_array($data)) throw new \RuntimeException('Parse failed.');

        return $data;
    }

} 