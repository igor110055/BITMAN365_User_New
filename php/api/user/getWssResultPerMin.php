<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $time = json_decode(file_get_contents("php://input"));
    $stmt = $query->getWssResultPerMin($time);

    $sql = $stmt->rowCount();
    if($sql > 0){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $res = $data[0]["JsonDataResult"];
        echo json_encode($res);
    }else{
        http_response_code(404);
        echo json_encode('No Record Found.');
    }