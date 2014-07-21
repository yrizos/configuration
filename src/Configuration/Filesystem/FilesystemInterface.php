<?php

namespace Configuration\Filesystem;

use Configuration\ConfigurationInterface;

interface FilesystemInterface extends ConfigurationInterface
{

    public function parseFile($path);

    public function addPath($path);

    public function getPaths();

} 