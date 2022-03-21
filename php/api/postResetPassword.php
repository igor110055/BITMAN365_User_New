<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $cgdata = new Gamingtables($db);

    parse_str($_POST['formData'], $_POST);

    $r_acctid = $_POST["r_acctid"];
    $r_password = md5($_POST["r_password"]);

    $user = $cgdata->postResetPassword($r_acctid,$r_password);
    echo json_encode($user);

?>