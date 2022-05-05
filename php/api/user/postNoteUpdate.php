<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    $stmt = $query->postNoteUpdate($_GET["e_Id"]);

    print_r($stmt);

    echo json_encode($stmt);

?>