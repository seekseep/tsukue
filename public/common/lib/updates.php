<?php

	include_once 'database.php';
	include_once 'tukue_creator_functions.php';

	if(isset($mysqli)){
		echo 'ある';
	}else{
		echo 'ない';
	}

	$creator_name = $_POST['creator_name'];

	creator_Updates($creator_name, $mysqli);