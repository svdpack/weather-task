<?php

namespace App\Controllers\Api;

use App\Models\HourlyTempModel;
use Exception;

class WeatherApiController
{
    public function day()
    {
        if (empty($_GET['day'])) {
            throw new Exception("There no day parameter! You need to send day in next format 'Y-m-d'", 422);
        }

        $day = $_GET['day'];
        if (!preg_match("/^[0-9]{4}-[0-1][0-2]-[0-3][0-9]$/", $day)) {
            throw new Exception("Bad format for day parameter! You need to send day in next format 'Y-m-d'", 422);
        }

        $temperatures = (new HourlyTempModel())->getDailyTemp($day);

        response()->success($temperatures);
    }

}