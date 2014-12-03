<?php

include_once __DIR__ . '/../vendor/autoload.php';

$config = new \Configuration\Configuration([__DIR__ . '/../tests/config/config.ini'], 'production');

foreach($config as $key => $value) {
    echo $key . ': ' . $value . PHP_EOL;
}

