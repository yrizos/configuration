<?php

namespace Configuration\Backend;


interface FilesystemInterface extends BackendInterface
{
    public function addPath($path);

    public function getPaths();
}