<?php

/**
 * @author vdbkpro
 * @copyright 2013
 */


date_default_timezone_set('Asia/Bangkok');
define('ONE_PAY_KEY', 'A3EFDFABA8653DF2342E8DAC29B51AF0');

define("SITE_NAME", "http://localhost/pi_maybay");
define("DIR", dirname(__FILE__));
define('SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','pi_maybay');
define('CACHE',false);
define('DATETIME_FORMAT',"y-m-d H:i:s");
define('PRIVATE_KEY','hoidinhnvbk');
session_start();
require_once DIR.'/common/minifi.output.php';
require_once DIR.'/common/functions.php';
ob_start("minify_output");
