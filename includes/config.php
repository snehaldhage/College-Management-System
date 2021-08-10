<?php
@session_start(); //mandatory if session is used in project.
@ob_start(); //optional
date_default_timezone_set("Asia/Kolkata");
require_once 'constant.php';
require_once 'helper.php';
spl_autoload_register('myautoloader');
function myautoloader($class_name)
{
    include $class_name . '.php';
}
$obj = Mylib::getInstance();  //singleton object 

