<?php

namespace Configuration\Filesystem;

class PhpArray extends AbstractFilesystem
{
    public function parseFile($path)
    {
        if (!(file_exists($path) && is_readable($path))) return false;

        ob_start();
        $result = include $path;
        ob_end_clean();

        return is_array($result) ? $result : false;
    }
}