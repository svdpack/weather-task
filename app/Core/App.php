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
        $headers = getallheaders();
        $x_token = $headers['x-token'];

        if ($x_token !== XTOKEN  ){
            self::error("Wrong token used!");
            die();
        }
        else{
            return TRUE;
        }

    }


    function error ($text)
    {
        $data['status']  = "ERROR";
        $data['message'] = $text;
        print json_encode ($data);
    }
}