<?php

namespace App\Core;

/*
********************************************************************************
*   Project:        test-task by PhpStorm
*   Description:    DBClass.php
*   Author:         Matsiyevskyy Oleg
*   Created:        17.01.2023
*   Mail:           aljos@shuvar.com
********************************************************************************
*/


use mysql_xdevapi\Exception;
use mysqli;
use mysqli_result;

class DB
{

    protected static ?DB $instance = null;

    private ?mysqli $connection = null;


    private function __construct()
    {
    }


    private function __clone()
    {
    }

    public function __destruct()
    {
        if (null !== $this->connection) {
            $this->connection?->close();
            $this->connection = null;
        }
    }

    /**
     * pattern Singleton
     *
     * @return static
     */
    final public static function init(): static
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }


    /**
     * pattern Lazy Load
     *
     * @return mysqli
     */
    private function connect(): mysqli
    {
        if (null === $this->connection) {
            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME,);
            $this->connection->set_charset(DB_CHARSET);

            if ($this->connection->connect_error) {
                throw new Exception($this->connection->connect_error);
            }
        }

        return $this->connection;
    }


    public function Qry($Qry): bool|mysqli_result
    {
        $pnCH = $this->connect();
        $lnID = mysqli_query($pnCH, $Qry);
        if (!$lnID) {
            if (isDebug()) {
                throw new Exception("Can't execute query: ".$Qry." || ".mysqli_errno($pnCH)." : ".mysqli_error($pnCH)); #only for debug,
            }
            return false;
        } else {
            return $lnID;
        }
    }

    public function prepare($value): int|string
    {
        $pnCH = $this->connect();

        $search = [
            chr(92),
            "C:/fakepath/",
            " union ",
            " select ",
            " delete ",
            " or ",
            " exec ",
        ];
        $replace = [
            '',
            "",
            "",
            "",
            "",
            "",
            "",
        ];
        $value = str_ireplace($search, $replace, $value);

        // Якщо змінна не число - то беремо її в кавички, та екрануємо
        if (!is_numeric($value)) {
            $value = "'".mysqli_real_escape_string($pnCH, $value)."'";
        }

        return $value;
    }

    /**
     * Функція, яка повертає масив з об'єктами записів
     *
     * @param $lnID  - Вказівник на результат запиту
     * @return array
     */
    public function getObject($lnID): array
    {
        $array = [];
        while ($row = @mysqli_fetch_object($lnID)) {
            $array[] = $row;
        }

        return $array;
    }


    public function getFieldByID(string $table, string $field, $id)
    {
        $lcQry = "select ".$field." from ".$table." where id".$table."=".$id;
        $lnID = $this->Qry($lcQry);
        $loData = $this->getOneObject($lnID);
        return $loData->$field;
    }


    public function setFieldByID(string $table, string $field, $val, $id): bool
    {
        $lcQry = "update ".$table." set ".$field."=".$val." where id".$table."=".$id;

        if ($this->Qry($lcQry)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Функція, яка повертає об'єкт одного запису
     *
     * @param $lnID  - Вказівник на результат запиту
     *
     * @return object|bool|null
     */
    private function getOneObject($lnID): object|bool|null
    {
        $row = mysqli_fetch_object($lnID);

        return $row;
    }


    /**
     * Функція, яка повертає кількіть записів після виконання запиту
     *
     * @param $lnID  - Вказівник на результат запиту
     * @return bool|int|string  - к-ть записів
     */
    private function RowCount($lnID): bool|int|string
    {
        if ($lnID) {
            return @mysqli_num_rows($lnID);
        } else {
            return false;
        }
    }


}
