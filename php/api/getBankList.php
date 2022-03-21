<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new User($db);
    $stmt = $query->getBankList();

    $sql = $stmt->rowCount();
    if($sql > 0){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }