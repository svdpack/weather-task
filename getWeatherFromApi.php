<?php
/*
********************************************************************************
*   Project:        test-task by PhpStorm
*   Description:    getTempFromApi.php
*   Author:         Matsiyevskyy Oleg
*   Created:        17.01.2023
*   Mail:           aljos@shuvar.com
********************************************************************************
*/

use App\Core\App;
use App\Services\WeatherService;

$app = new App();

$Weather = new WeatherService();
$Weather->setHourlyTemp();
