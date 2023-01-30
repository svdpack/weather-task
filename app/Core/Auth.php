<?php

namespace App\Core;

/*
********************************************************************************
*   Project:        test-task by PhpStorm
*   Description:    appClass.php
*   Author:         Matsiyevskyy Oleg
*   Created:        17.01.2023
*   Mail:           aljos@shuvar.com
********************************************************************************
*/

class Auth
{
    static function checkToken(): bool
    {
        $x_token = null;
        foreach (getallheaders() as $keyHead => $valHead) {
            if (strtolower($keyHead) === 'x-token') {
                $x_token = $valHead;
                break;
            }
        }

        return $x_token === env('XTOKEN');
    }
}