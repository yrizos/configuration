<?php

require_once "../vendor/autoload.php";

use Configuration\Configuration;

$files = ["default.ini", "default.json", "default.php"];
$envs  = [Configuration::DEFAULT_ENVIRONMENT, "production"];

foreach ($files as $file) {
    echo "<b>{$file}</b><br />";

    foreach ($envs as $env) {
        $conf = Configuration::file($file, $env);
        echo "{$env}: " . $conf->option1 . " " . $conf["option2"] . "<br>";
    }

    echo "<hr>";
}
