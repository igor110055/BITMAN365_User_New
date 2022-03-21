<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $limit = $_GET["limit"];
    $sort = $_GET["sort"];
    $stmt = $query->getBinanceApiData($sort,$limit);

    $sql = $stmt->rowCount();
    $arr = array();
    if($sql > 0){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $array[] = [
                "time" => floatval($row["a_time"]),
                "open" => $row["a_open"],
                "high" => $row["a_high"],
                "low" => $row["a_low"],
                "close" => $row["a_close"]
            ];
        }
        echo json_encode( $array);
    }else{
        http_response_code(404);
        echo json_encode('No Record Found.');
    }