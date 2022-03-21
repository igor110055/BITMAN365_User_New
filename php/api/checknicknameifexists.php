<?php

    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $cgdata = new User($db);

    $nickname = json_decode(file_get_contents("php://input"));

    $stmt = $cgdata->checkNicknameIfExists($nickname);

    echo json_encode($stmt->rowCount());