<?php 
	session_start();
	session_destroy();
	header("Location: http://$_SERVER[HTTP_HOST]/BITMAN365");

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once 'php/config/Database.php';
	include_once 'php/class/Users.php';

	$database = new Database();
    $db = $database->getConnection();
	$query = new User($db);
	$stmt = $query->destroyUserSession($_GET["code"]);
?>