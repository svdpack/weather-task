<?php

use App\Controllers\Api\WeatherApiController;
use App\Core\Auth;

$in_URL = parse_url($_SERVER['REQUEST_URI']) ?? '';
$route = trim($in_URL['path'] ?? '', '/');

switch ($route) {
    case "api/weather":
        if (!Auth::checkToken()) {
            throw new Exception('Wrong token used!', 401);
        }

        (new WeatherApiController())->day();
        break;

    case "":
        echo 'Welcome!';

        break;

    default:
        throw new Exception('Not Found', 404);
}