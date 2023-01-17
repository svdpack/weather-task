<?php

/*
********************************************************************************
*   Project:        test-task by PhpStorm
*   Description:    DBClass.php
*   Author:         Matsiyevskyy Oleg
*   Created:        17.01.2023
*   Mail:           aljos@shuvar.com
********************************************************************************
*/

class DB
{


    function __construct ()
    {
        global $pnCH;
        $pnCH = mysqli_connect (DB_HOST, DB_USER, DB_PSWD) or die ("Can't connect to DB");

        mysqli_select_db ($pnCH, DB_NAME) or die ("Can't  select DB");
        mysqli_query ($pnCH, DB_CHARSET); //Задаємо кодування для бази даних
        return TRUE;
    }


    function Qry ($Qry)
    {
        global $pnCH;
        $lnID = mysqli_query ($pnCH, $Qry);
        if (!$lnID) {
            echo ("Can't execute query: ".$Qry." || ".mysqli_errno ($pnCH)." : ".mysqli_error ($pnCH)); #only for debug,
            return FALSE;
        } else {

            return $lnID;
        }
    }


    function prepare ($value)
    {
        global $pnCH;
        $search  = array (
            chr (92),
            "C:/fakepath/",
            " union ",
            " select ",
            " delete ",
            " or ",
            " exec "
        );
        $replace = array (
            '',
            "",
            "",
            "",
            "",
            "",
            ""
        );
        $value   = str_ireplace ($search, $replace, $value);

        // Якщо змінна не число - то беремо її в кавички, та екрануємо
        if (!is_numeric ($value)) {
            $value = "'".mysqli_real_escape_string ($pnCH, $value)."'";
        }


        return $value;
    }





    #	Функція, яка повертає масив з об'єктами записів
    #   INPUT:
    #		resource $lnID - Вказівник на результат запиту
    #	OUTPUT:
    #       array
    function getObject ($lnID)
    {
        $array = array ();
        while ($row = @mysqli_fetch_object ($lnID)) {
            $array[] = $row;
        }

        return $array;
    }


    #	Функція, яка повертає об'єкт одного запису
    #   INPUT:
    #		resource $lnID - Вказівник на результат запиту
    #	OUTPUT:
    #       object
    function getOneObject ($lnID)
    {
        $row = mysqli_fetch_object ($lnID);

        return $row;
    }



    #	Функція, яка повертає кількіть записів після виконання запиту
    #   INPUT:
    #		resource $lnID - Вказівник на результат запиту
    #	OUTPUT:
    #       integer к-ть записів
    function RowCount ($lnID)
    {
        if ($lnID) {
            return @mysqli_num_rows ($lnID);
        } else {
            return FALSE;
        }

    }


    #	Функція, яка конвертує дату дд.мм.рр в рр-мм-дд
    #   INPUT:
    #		$date - дата
    #	OUTPUT:
    #       $date - дата Mysql
    function DateToMysql ($date)
    {
        $dateArr = explode (".", $date);
        $newDate = $dateArr[2]."-".$dateArr[1]."-".$dateArr[0];

        return $newDate;
    }


    function getFieldByID ($table, $field, $id)
    {
        $lcQry  = "select ".$field." from ".$table." where id".$table."=".$id;
        $lnID   = $this->Qry ($lcQry);
        $loData = $this->getOneObject ($lnID);

        return $loData->$field;
    }


    function setFieldByID ($table, $field, $val, $id)
    {
        $lcQry = "update ".$table." set ".$field."=".$val." where id".$table."=".$id;

        if ($this->Qry ($lcQry)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


}
