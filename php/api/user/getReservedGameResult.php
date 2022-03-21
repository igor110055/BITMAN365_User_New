<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $array = json_decode(file_get_contents("php://input"));
    $stmt = $query->getReserveGameResult();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);

    // $newArr = array();
    // foreach($array as $key => $val){
        
    //     foreach($data as $skey => $sval){
    //         if(in_array($sval["r_Time_Unix"], $array)){
    //             $newArr[$skey] = $sval["r_Time_Unix"];
                
    //             // if($val["r_Time_Unix"] == $sval){
    //             //     $newArr[$skey] = $array[$skey];
    //             // }else{
    //             //    $newArr[$skey] = $array[$skey] . 'test';
    //             // }
    //         }
    //         //$newArr[$key] = $array[$key];
    //     }
    // }
    // $sql = $stmt->rowCount();
    // if($sql > 0){
    //     $arr = array();
    //     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    //         if (in_array($row["r_Time_Unix"], $array)) {
    //             foreach($array as $key => $val){
    //                 if($row["r_Time_Unix"] == $val){
    //                     $arr[] = $row["r_Time_Unix"];
    //                 }
                    
    //             }
                
                
    //         }
    //         print_r($arr);
            
    //     }
        
    //     //echo json_encode($data);
    // }else{
    //     http_response_code(404);
    //     echo json_encode('No Record Found.');
    // }