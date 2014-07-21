<?php

namespace Configuration\Filesystem;

class Ini extends AbstractFilesystem
{

    public function parseFile($path)
    {
        $result = file_exists($path) && is_readable($path) ? @parse_ini_file($path) : false;

        return is_array($result) ? $result : false;
    }

}