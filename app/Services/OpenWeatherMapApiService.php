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


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OpenWeatherMapApiService
{

    const API_URL = 'https://api.openweathermap.org/data/2.5/weather';


    /**
     * @throws GuzzleException
     */
    public function setHourlyTemp(): ?object
    {
        $query = [
            'q' => env('CITY'),
            'units' => 'metric',
            'lang' => 'uk',
            'appid' => env('APPID'),
        ];

        $client = new Client();
        $response = $client->get(static::API_URL, [
                'query' => $query,
            ]
        );

        $responseCode = $response->getStatusCode();

        if ($responseCode >= 200 && $responseCode < 300) {
            return json_decode($response->getBody()->getContents());
        }

        return null;
    }
}