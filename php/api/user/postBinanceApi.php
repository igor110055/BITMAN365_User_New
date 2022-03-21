<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    $bidata = json_decode(file_get_contents("php://input"));
    foreach($bidata as $key => $val){
        $bipost = $query->postBinanceData($val);
    }
    echo json_encode($bipost);