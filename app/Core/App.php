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

class App
{
    function __construct ()
    {
        $this->db = new DB();

        self::checkToken();

        return TRUE;
    }

    function checkToken()
    {
        $x_token = null;
        foreach (getallheaders() as $keyHead => $valHead) {
            if (strtolower($keyHead) === 'x-token') {
                $x_token = $valHead;
                break;
            }
        }

        if ($x_token !== XTOKEN  ){
            throw new \Exception('Wrong token used!', 401);
        }
    }


    function error ($text)
    {
        $data['status']  = "ERROR";
        $data['message'] = $text;
        print json_encode ($data);
    }
}