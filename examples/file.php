<?php

require_once "../vendor/autoload.php";

use Configuration\Reader;

$files = ["default.ini", "default.json", "default.php"];
$envs = ["development", "production"];

foreach ($files as $file) {
    $file = "../tests/data/{$file}";

    echo "<b>{$file}</b><br />";

    foreach ($envs as $env) {
        $conf = Reader::file($file, $env);
        echo "{$env}: " . $conf->option1 . " " . $conf["option2"] . "<br>";
    }

    echo "<hr>";
}
