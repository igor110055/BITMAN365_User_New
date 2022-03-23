<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new User($db);
    $auth = new Authentication($db);
    $get_ip = new Getuseripaddress($db);
    $ip = $get_ip->GetIpAddress();
    $detect = new Mobile_Detect;

    parse_str($_POST['formData'], $_POST);

    $account_code = $_POST["account_code"];
    $password = $auth->encrypt_decrypt('encrypt', $_POST["password"]);

    $login = $query->login($account_code,$password);
    if(json_encode($login) == 'true'){
        echo json_encode($login);
        if ($detect->isMobile() || $detect->isTablet()) {
            $logs = $query->userLogs('Mobile_Tablet',$account_code,$ip);
            if( $detect->isiOS() ){ 
                $logs = $query->userLogs('IOS',$account_code,$ip);
            }
            if( $detect->isAndroidOS() ){
                $logs = $query->userLogs('ANDROID',$account_code,$ip);
            }
        } else { 
            $logs = $query->userLogs('DESKTOP',$account_code,$ip);
        }
    }else{
        echo json_encode(0);
    }
?>