<?php

// create application settings
define("SITE_PATH", "http://localhost/CMS/app_main/");
define("APP_PATH", str_replace("\\", "/", dirname(__FILE__)) . "/");

define("SITE_RESOURCES", "http://localhost/CMS/app_main/resources/");
define("APP_RESOURCES", "http://localhost/CMS/app_main//app/resources/");
define("SITE_CSS", "http://localhost/CMS/app_main/app/resources/css/style.css");

// database settings
$server = 'localhost';
$user = 'root';
$pass = 'mysql';
$db = 'cms';

// error reporting
mysqli_report(MYSQLI_REPORT_ERROR);	

// create CMS core object
require_once(APP_PATH . "core/core.php");
$CMS = new CMS_Core($server, $user, $pass, $db);
