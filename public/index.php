<?php
/*
********************************************************************************
*   Project:        test-task by PhpStorm
*   Description:    index.php
*   Author:         Matsiyevskyy Oleg
*   Created:        17.01.2023
*   Mail:           aljos@shuvar.com
********************************************************************************
*/

try {
    require_once __DIR__.'/../bootstrap.php';
    require_once PATH_CORE.'routers.php';
} catch (Throwable $ex) {
    response()->error($ex->getMessage(), $ex->getCode());
}

exit();