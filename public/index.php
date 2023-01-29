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
use App\Services\WeatherService;

require_once __DIR__.'/../bootstrap.php';

$app = new App(); # Application initialization


$Weather = new WeatherService();


if ($_GET['day'] or !empty($_GET['day'])) {
    try {
        $day = $_GET['day'];
        if (preg_match("/^[0-9]{4}-[0-1][0-2]-[0-3][0-9]$/", $day)) {
            $Weather->getDailyTemp();
        } else {
            $app->error("Bad format for day parameter! You need to send day in next format 'Y-m-d'");
        }
    } catch (Exception $ex) {
        $app->error($ex->getMessage());
    }

} else {
    $app->error("There no day parameter! You need to send day in next format 'Y-m-d'");
}

