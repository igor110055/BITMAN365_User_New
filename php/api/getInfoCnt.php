<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
  
    $inqs = $query->getInfoCntNote();
    $inq = $inqs->fetchAll(PDO::FETCH_ASSOC);

    $stmt1 = $query->getNotification();
    $notifcnt = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    $stmt2 = $query->checkCategoryRequest();
    $notif = $stmt2->fetchAll(PDO::FETCH_ASSOC);


    $array = array(
        "InquiryApplication" => ($inq[0]["Cnt"] > 0) ? $inq[0]["Cnt"] : 0,
        "NotifCnt" => count($notifcnt),
        "Notif" => $notif
    );
    echo json_encode($array);
?>