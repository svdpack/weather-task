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

class WeatherClass
{

    function __construct()
    {

        $this->db = new DB();

        return TRUE;
    }


    function curlConnect($url)
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

    function setHourlyTemp()
    {
        $url =  APPLINK.'q='.CITY.'&units=metric&lang=uk&appid='.APPID; # build API URL

        $responce = $this->curlConnect($url);


        $obj = json_decode($responce);

        $lcQry = "INSERT INTO hourly_temp SET
                temp  = ". $obj->main->temp . ",
                dateT = '". gmdate("Y-m-d H:i:s", $obj->dt) ."'";

        $lnID  = $this->db->Qry($lcQry);


    }


    function getDailyTemp()
    {
        $day   = $this->db->prepare($_GET['day']);
        $lcQry = "SELECT temp, dateT FROM hourly_temp WHERE date(dateT)=".$day;
        $lnID  = $this->db->Qry($lcQry);

        $loData = $this->db->getObject($lnID);

        print(json_encode($loData));

    }



}