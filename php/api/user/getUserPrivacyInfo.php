<?php
    include_once 'includes.php';
    
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $stmt = $query->getUserPrivacyInfo();


    $sql = $stmt->rowCount();
    if($sql > 0){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
		// $array[] = array(
		// 	"password" => encrypt_decrypt('decrypt', $row["u_Password"]);
		// );
    }