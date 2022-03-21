<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new User($db);
    $auth = new Authentication($db);

    parse_str($_POST['formData'], $_POST);

    $account_code = $_POST["account_code"];
    $password = $auth->encrypt_decrypt('encrypt', $_POST["password"]);

    $login = $query->login($account_code,$password);
    echo json_encode($login);
?>