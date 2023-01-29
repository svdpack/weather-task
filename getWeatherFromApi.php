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

use App\Services\WeatherService;

require_once __DIR__.'/bootstrap.php';


$Weather = new WeatherService();
$Weather->setHourlyTemp();
