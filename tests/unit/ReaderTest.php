<?php

use Configuration\Reader;
use Configuration\ConfigurationInterface;

class ReaderTest extends \PHPUnit_Framework_TestCase
{
    private $files = [];

    protected function setUp()
    {
        $files = ["default.ini", "default.json", "default.php"];
        $dir   = dirname(__FILE__);

        foreach ($files as $file) {
            $path = $dir . "/../data/{$file}";
            if (file_exists($path)) $this->files[] = realpath($path);
        }
    }

    public function testRead()
    {
        $envs = ["development", "production"];

        foreach ($this->files as $file) {
            $conf = Reader::file($file, "development");

            $this->assertInstanceOf("Configuration\\ConfigurationInterface", $conf);
            $this->assertEquals("hello", $conf->option1);
            $this->assertEquals("world", $conf->option2);

            $conf = Reader::file($file, "production");

            $this->assertInstanceOf("Configuration\\ConfigurationInterface", $conf);
            $this->assertEquals("goodbye", $conf->option1);
            $this->assertEquals("world", $conf->option2);
        }

    }

} 