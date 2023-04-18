<?php

include("config/database.php");

spl_autoload_register(function ($className) {
    $path = $className . '.php';
    if (is_file($path))
        require($path);
});

$core = core\Core::getInstance();

$core->Initialize();

// \Models\User::addUser("123", "123", "123", "123");

$core->Run();
$core->Done();