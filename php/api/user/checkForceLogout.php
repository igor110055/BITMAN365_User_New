<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $stmt = $query->checkUserForceLogout();

    $sql = $stmt->rowCount();
    if($sql > 0){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if($data[0]['u_State'] == 3){
            echo '<script>window.location.href="./logout.php?code="+'.$data[0]['u_State'].'</script>';
        }
    }else{
        $data[] = array("t_Amount_in_Total" => 0);
        echo json_encode($data);
    }