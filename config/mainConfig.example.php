<?php
/*
********************************************************************************
*   Project:        test-task by PhpStorm
*   Description:    mainConfig.php
*   Author:         Matsiyevskyy Oleg
*   Created:        17.01.2023
*   Mail:           aljos@shuvar.com
********************************************************************************
*/

####################################
###   Database Connect Options    ###
####################################
define("DB_HOST","localhost");
define("DB_NAME","test_db");
define("DB_USER","root");
define("DB_PSWD","");
define("DB_CHARSET","SET NAMES utf8");


if (!defined('APP_DEBUG')) {
    define('APP_DEBUG', false); // show debug info, error & trace
}


define('APPID','');
define('CITY','Kyiv');

define('XTOKEN','');


