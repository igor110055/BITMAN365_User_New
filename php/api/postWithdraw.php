<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $result = $query->postWithdraw($data);
    echo json_encode($result);
?>