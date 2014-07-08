<?php

namespace Configuration\Backend;

class Ini extends AbstractFilesystem implements FilesystemInterface
{

    protected function parseFile($path)
    {
        $result = @parse_ini_file($path, true);

        return is_array($result) ? $result : false;
    }

}