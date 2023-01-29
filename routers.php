<?php

use App\Services\WeatherService;

$in_URL = parse_url($_SERVER['REQUEST_URI']) ?? '';
$route = trim($in_URL['path'] ?? '', '/');

switch ($route) {
    case "api/weather":
        if (!empty($_GET['day'])) {
            $day = $_GET['day'];
            if (preg_match("/^[0-9]{4}-[0-1][0-2]-[0-3][0-9]$/", $day)) {
                $Weather = new WeatherService();
                $Weather->getDailyTemp();
            } else {
                throw new Exception("Bad format for day parameter! You need to send day in next format 'Y-m-d'", 422);
            }

        } else {
            throw new Exception("There no day parameter! You need to send day in next format 'Y-m-d'", 422);
        }
        break;

    default:
        throw new Exception('Not Found', 404);
}