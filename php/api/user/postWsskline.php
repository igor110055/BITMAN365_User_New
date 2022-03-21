<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    $results = json_decode(file_get_contents("php://input"));
    $reserved = $query->getReservedResultPerMinute($results[0]->time);
    $res = $reserved->fetch(PDO::FETCH_ASSOC);
    foreach($results as $key => $val){
        $result = $query->postWsskline($val,$res);
        echo json_encode($result);    
    }