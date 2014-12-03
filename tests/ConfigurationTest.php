<?php
namespace ConfigurationTest;

use Configuration\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{

    private $paths = [];

    public function setUp()
    {
        $this->paths = [
            __DIR__ . '/data/config.yml',
            __DIR__ . '/data/config.ini',
            __DIR__ . '/data/config.php',
            __DIR__ . '/data/config.json',
        ];
    }

    public function testNoEnvironment()
    {
        $config = new Configuration($this->paths, false);

        $this->assertTrue(isset($config['yaml_key1']));
        $this->assertTrue(isset($config['yaml_key2']));

        $this->assertEquals($config['yaml_key1'], 'yaml value 1');
        $this->assertEquals($config['yaml_key2'], 'yaml value 2');

        $this->assertTrue(isset($config['ini_key1']));
        $this->assertTrue(isset($config['ini_key2']));

        $this->assertEquals($config['ini_key1'], 'ini value 1');
        $this->assertEquals($config['ini_key2'], 'ini value 2');

        $this->assertTrue(isset($config['php_key1']));
        $this->assertTrue(isset($config['php_key2']));

        $this->assertEquals($config['php_key1'], 'php value 1');
        $this->assertEquals($config['php_key2'], 'php value 2');

        $this->assertTrue(isset($config['json_key1']));
        $this->assertTrue(isset($config['json_key2']));

        $this->assertEquals($config['json_key1'], 'json value 1');
        $this->assertEquals($config['json_key2'], 'json value 2');
    }

    public function testEnvironment()
    {
        $config = new Configuration($this->paths, 'production');

        $this->assertTrue(isset($config['yaml_key1']));
        $this->assertTrue(isset($config['yaml_key2']));
        $this->assertTrue(isset($config['yaml_key3']));

        $this->assertEquals($config['yaml_key1'], 'yaml value 1');
        $this->assertEquals($config['yaml_key2'], 'yaml value 2 - production');
        $this->assertEquals($config['yaml_key3'], 'yaml value 3');

        $this->assertTrue(isset($config['ini_key1']));
        $this->assertTrue(isset($config['ini_key2']));
        $this->assertTrue(isset($config['ini_key3']));

        $this->assertEquals($config['ini_key1'], 'ini value 1');
        $this->assertEquals($config['ini_key2'], 'ini value 2 - production');
        $this->assertEquals($config['ini_key3'], 'ini value 3');

        $this->assertTrue(isset($config['php_key1']));
        $this->assertTrue(isset($config['php_key2']));
        $this->assertTrue(isset($config['php_key3']));

        $this->assertEquals($config['php_key1'], 'php value 1');
        $this->assertEquals($config['php_key2'], 'php value 2 - production');
        $this->assertEquals($config['php_key3'], 'php value 3');

        $this->assertTrue(isset($config['json_key1']));
        $this->assertTrue(isset($config['json_key2']));
        $this->assertTrue(isset($config['json_key3']));

        $this->assertEquals($config['json_key1'], 'json value 1');
        $this->assertEquals($config['json_key2'], 'json value 2 - production');
        $this->assertEquals($config['json_key3'], 'json value 3');
    }
}