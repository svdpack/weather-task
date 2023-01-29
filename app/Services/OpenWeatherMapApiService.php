<?php

/*
********************************************************************************
*   Project:        test-task by PhpStorm
*   Description:    getWeatherClass.php
*   Author:         Matsiyevskyy Oleg
*   Created:        17.01.2023
*   Mail:           aljos@shuvar.com
********************************************************************************
*/

namespace App\Services;


class OpenWeatherMapApiService
{

    const API_URL = 'https://api.openweathermap.org/data/2.5/weather';


    public function setHourlyTemp(): ?object
    {
        $query = http_build_query([
            'q' => CITY,
            'units' => 'metric',
            'lang' => 'uk',
            'appid' => APPID,
        ]);

        $url = static::API_URL.'?'.$query;

        $response = $this->curlConnect($url);

        if (false !== $response) {
            return json_decode($response);
        }

        return null;
    }


    function curlConnect($url): bool|string
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        #$arr_geaders[] = "secret-key:tLGDa6ct6pARmcyVwtEE";
        #curl_setopt($ch, CURLOPT_HTTPHEADER, $arr_geaders);

        $response = curl_exec($ch);

        #$status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $response;
    }
}