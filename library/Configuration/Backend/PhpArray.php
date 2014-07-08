<?php

namespace Configuration\Backend;

class PhpArray extends AbstractFilesystem implements FilesystemInterface
{
    protected function parseFile($path)
    {
        ob_start();
        $result = @include($path);
        ob_end_clean();

        return is_array($result) ? $result : false;
    }
}