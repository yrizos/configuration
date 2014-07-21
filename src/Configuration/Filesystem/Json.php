<?php

namespace Configuration\Filesystem;

class Json extends AbstractFilesystem
{
    public function parseFile($path)
    {
        $contents = file_exists($path) && is_readable($path) ? @file_get_contents($path) : false;
        $result   = $contents ? @json_decode($contents, true) : false;

        return is_array($result) ? $result : false;
    }
}