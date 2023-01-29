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

use App\Models\HourlyTempModel;
use App\Services\OpenWeatherMapApiService;

require_once __DIR__.'/bootstrap.php';


$service = new OpenWeatherMapApiService();
$weather = $service->setHourlyTemp();

if (!empty($weather)
    && !empty($weather?->dt)
    && !empty($weather?->main?->temp)) {

    $date = gmdate("Y-m-d H:i:s", $weather?->dt);
    $temperature = $weather?->main?->temp ?? null;

    if (!is_null($temperature)) {
        (new HourlyTempModel())->addTemperature($date, $temperature);
    } else {
        throw new Exception('WeatherService: Temperature empty');
    }
} else {
    throw new Exception('WeatherService: Not correct response');
}
