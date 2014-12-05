<!--

@param $_SERVER['HTTP_REFERER']

-->

<?php

	session_start();

	include_once 'api/tukue_creator_functions.php';

	$input_username = $_POST['name'];

	$input_password = $_POST['pass'];

	$db_username = Get_CreatorName($input_username);

	if($input_username == $db_username && $input_password == 9999) {
		session_regenerate_id(TRUE);
		$_SESSION['username'] = $input_username;
		header("location: dashboard.php");
	}else {
		header("location: login.php");
	}
?>
