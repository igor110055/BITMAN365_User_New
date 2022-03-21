<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    $data = json_decode(file_get_contents("php://input"));
    $dt_rowid = $data[0]->DT_RowId;
    $delete = $query->postDeleteUser($dt_rowid);
    echo json_encode($delete);