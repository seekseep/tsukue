<?php
	require 'functions.php';
// 	require 'confirm.php';
	var_dump($package_name);
	delete_dir($package_name);
	exit();
	header("LOCATION: register.php");
?>