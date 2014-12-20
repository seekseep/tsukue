<?php

	session_start();

	require_once 'api/tukue_creator_functions.php';
	require_once 'api/tukue_package_functions.php';

	$input_creator_name = $_POST['creator_name']; // 入力されたユーザー名
	$input_creator_pass = $_POST['creator_pass']; // 入力されたパスワード

	$creator_name = get_CreatorName( $input_creator_name );
	$creator_pass = get_CreatorPass( $input_creator_name );

	if( $input_creator_name == $creator_name && password_verify( $input_creator_pass, $creator_pass ) ) {
		$_SESSION['creator_name'] = $creator_name;
		header("location: dashboard.php");
		exit();
	} else {
		header("location; login.php");
		exit();
	}

?>
