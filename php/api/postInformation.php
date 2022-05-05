<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new User($db);
    $auth = new Authentication($db);
    parse_str(@$_POST['formData'], $_POST);
    $pass = $auth->encrypt_decrypt('encrypt', @$_POST["user_pass"]);
    $cat = (@$_GET["category_title"]) ? @$_GET["category_title"] : @$_POST["category_title"];
    switch ($cat) {
        case "note_update":  
            $post = $query->postNoteUpdate($_GET);
            echo $post;
            break;
       
            
}
?>