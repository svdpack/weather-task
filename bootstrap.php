<?php

if (!defined('PATH_CORE')) {
    define('PATH_ROOT', __DIR__.DIRECTORY_SEPARATOR);
}

require_once PATH_ROOT.'config/mainConfig.php';

require_once PATH_ROOT.'app/helpers.php';

spl_autoload_register(function ($name_class_all) {
    $nameClassArray = explode('\\', $name_class_all);

    if (!empty($nameClassArray[0]) && $nameClassArray[0] === 'App') {
        $nameClassArray[0] = 'app';

        $pathClass = realpath(PATH_ROOT.implode(DIRECTORY_SEPARATOR, $nameClassArray).".php");
        if (file_exists($pathClass)) {
            require_once $pathClass;
        }
    }
});


