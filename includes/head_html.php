<?php
    include_once 'php/config/Database.php';
    include_once 'php/class/Users.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-control" content="no-cache">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="plugins/bootstrap-4.0.0/css/bootstrap.css">
        <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="plugins/jquery-confirm-3.3.2/css/jquery-confirm.min.css">
        <link rel="stylesheet" href="plugins/iziToast-master/dist/css/iziToast.min.css">
        <link rel="stylesheet" href="assets/css/custom_dropdown.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/media.css">
        <style>
            #pagination img{
                width: 20px;
                height: 20px;
            }
        </style>
        
        <title>BITMAN365</title>
        <?php
            if (isset($linkcss) || is_array(@$linkcss)) {
                foreach ($linkcss as $css) {
                    echo "<link href='$css'  rel='stylesheet'>";
                }
            }
        ?>
    </head>
    <body class="pageLoad">