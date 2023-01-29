<?php

namespace App\Commands;

use App\Models\HourlyTempModel;
use App\Services\OpenWeatherMapApiService;
use Exception;

class WeatherSaveCommand
{
    public function __invoke()
    {
        $service = new OpenWeatherMapApiService();
        $weather = $service->setHourlyTemp();

        dump($weather);

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
    }
}