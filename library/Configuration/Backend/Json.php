<?php

namespace Configuration\Backend;

class Json extends AbstractFilesystem implements FilesystemInterface
{
    protected function parseFile($path)
    {
        $result = @file_get_contents($path);

        if ($result) $result = @json_decode($result, true);

        return is_array($result) ? $result : false;
    }
}