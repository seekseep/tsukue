<?php
	require_once 'api/tukue_package_functions.php';
	require_once 'api/tukue_img_functions.php';
	require_once 'api/tukue_creator_functions.php';
	require_once 'api/tukue_object_functions.php';
	require_once 'api/functions.php';

// 	echo  '<pre>';
// 	var_dump($_POST);
// 	exit;


	$creator_id = getCreator_id( 'test' );
	package_register( $_FILES, $_POST, $creator_id );

?>