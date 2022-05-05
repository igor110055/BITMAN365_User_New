<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    $stmt = $query->checkUserForceLogout();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $inqs = $query->getInfoCntNote();
    $inq = $inqs->fetchAll(PDO::FETCH_ASSOC);

    $balance = $query->getUserCashBalance();
    $balances = $balance->fetchAll(PDO::FETCH_ASSOC);

    $note = $query->getNoteList();
    $notes = $note ->fetchAll(PDO::FETCH_ASSOC);

    $array = array(
        "noteCnt" => ($inq[0]["Cnt"] > 0) ? $inq[0]["Cnt"] : 0,
        "check" => $data,
        "balance" => $balances,
        "note" => $notes
    );



    echo json_encode($array);


    // $sql = $stmt->rowCount();
    // if($sql > 0){
    //     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    //     if($data[0]['u_State'] == 3){
    //         echo '<script>window.location.href="./logout.php?code="+'.$data[0]['u_State'].'</script>';
    //     }
    // }else{
    //     $data[] = array("t_Amount_in_Total" => 0);
    //     echo json_encode($data);
    //     echo json_encode($inq);
    // }