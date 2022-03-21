<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $timeunix = json_decode(file_get_contents("php://input"));
    $stmt = $query->checkTimeBetPerMin($timeunix[0]->time);

    $sql = $stmt->rowCount();
    if($sql > 0){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }