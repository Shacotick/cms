<?php

// підключення файлу з конфігами
include("config/database.php");
include("config/params.php");

// автозагрузка кожної сторінки
spl_autoload_register(function ($className) {
    $path = $className . '.php';
    if (is_file($path))
        require($path);
});

$core = core\Core::getInstance();
$core->Initialize();
$core->Run();
$core->Done();