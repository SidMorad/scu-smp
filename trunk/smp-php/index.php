<?php
require('smp/Constants.php');
require('smp/controller/Controller.php'); 

// Include a local PEAR copy on a shared host
set_include_path('~/pear/lib' . PATH_SEPARATOR . get_include_path());

// This option also can be set on php.ini
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

smp_controller_Controller::run();