<?php

namespace App\Models;

use App\Core\DB;

class HourlyTempModel
{
    private DB $db;

    private string $table = 'hourly_temp';

    function __construct()
    {
        $this->db = DB::init();
    }

    public function getDailyTemp(string $day)
    {
        $day = $this->db->prepare($day);
        $lcQry = 'SELECT temp, dateT FROM '.$this->table.' WHERE date(dateT)='.$day;
        $lnID = $this->db->Qry($lcQry);

        return $this->db->getObject($lnID);
    }


    public function addTemperature(string $date, float $temp): void
    {
        $date = $this->db->prepare($date);
        $temp = $this->db->prepare($temp);

        $lcQry = 'INSERT INTO '.$this->table.' SET temp  = '.$temp.', dateT = '.$date;
        $this->db->Qry($lcQry);
    }
}