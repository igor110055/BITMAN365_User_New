<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    $unixtime = json_decode(file_get_contents("php://input"));
    $gameupdate = $query->getGameResservedMinUpdate($unixtime);
    echo json_encode($gameupdate);