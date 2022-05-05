<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $unix = json_decode(file_get_contents("php://input"));
    $stmt = $query->getOpenBet($unix);

    $sql = $stmt->rowCount();
    if($sql > 0){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }