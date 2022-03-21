<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    $arr = json_decode(file_get_contents("php://input"));
    foreach($arr as $key => $val){
        $prpost = $query->postPurchaserequest($val);
    }
    echo json_encode($prpost);