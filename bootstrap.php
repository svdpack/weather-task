<?php

if (!defined('PATH_CORE')) {
    define('PATH_CORE', __DIR__.DIRECTORY_SEPARATOR);
}

require_once PATH_CORE.'config/mainConfig.php';

spl_autoload_register(function ($name_class_all) {
    $nameClassArray = explode('\\', $name_class_all);

    if (!empty($nameClassArray[0]) && $nameClassArray[0] === 'App') {
        $nameClassArray[0] = 'app';

        $pathClass = realpath(PATH_CORE.implode('/', $nameClassArray).".php");

        if (file_exists($pathClass)) {
            require_once $pathClass;
        }
    }
});


