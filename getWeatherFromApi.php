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

require ("classes/appClass.php");

$app = new app(); # Application initialization


require ("classes/WeatherClass.php");

$Weather = new WeatherClass();

$Weather->setHourlyTemp();