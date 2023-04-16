<?php

namespace lib;

spl_autoload_register(function (string $class) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $class . '.php';
    $path = str_replace('\\', '/', $path);
    if (is_readable($path)) {
        include $path;
        return;
    }
    // $path = $_SERVER['DOCUMENT_ROOT']."/vendor/framework/ide_helper.php";
    // if(is_readable($path))
    // {
    //     include $path;
    //     return;
    // }        
    else {
        echo "<br>" . "Ошибка, не получилось прочитать файл: $path" . PHP_EOL . "<br>";
    }
});
