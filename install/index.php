<?php
include('helper.php');
$error = array();
if(isset($_POST['db_server'])){
	$db_server = $_POST['db_server'];
	$db_user = $_POST['db_user'];
	$db_password = $_POST['db_password'];
	$db_name = $_POST['db_name'];
	$driver = $_POST['driver'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	if(!$db_server){
		$error['db_server'] = 'Enter database server name';
	}
	if(!$db_user){
		$error['db_user'] = 'Enter database user name';
	}

	if(!$db_name){
		$error['db_name'] = 'Enter database name';
	}
	if(!$email){
		$error['email'] = 'Enter email';
	}
	if(!$password){
		$error['password'] = 'Enter password';
	}
	if (!class_exists('PDO') && $driver=='pdo'){
		$error['pdo'] = 'PDO class not found! Select Mysqli or contact hosting company';
	}
} else {
	$db_server =   '';
	$db_user = '';
	$db_password = '';
	$db_name = '';
	$driver = 'mysqli';
	$email = '';
	$password = '';
}
if(isset($_POST['db_server']) && !$error){
	create_config($_POST);
	create_db($_POST);
	include('success.tpl');
} else {
	include('main.tpl');
}
?>
