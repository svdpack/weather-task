<?php

if (!defined('PATH_CORE')) {
    define('PATH_ROOT', __DIR__.DIRECTORY_SEPARATOR);
}

require PATH_ROOT.'vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(PATH_ROOT)->load();
