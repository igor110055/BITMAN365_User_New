<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/Database.php';
    include_once '../class/Users.php';
    include_once '../class/Authentication.class.php';
    include_once '../class/Getuseripaddress.class.php';
    include_once '../class/Mobile_Detect.class.php';
    include_once '../class/Getcountryinfo.class.php';