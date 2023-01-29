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

use App\Core\App;

require_once __DIR__.'/../bootstrap.php';

$app = new App(); # Application initialization

try {
    require_once PATH_CORE.'routers.php';
} catch (Throwable $ex) {
    $app->error($ex->getMessage());
}

exit();