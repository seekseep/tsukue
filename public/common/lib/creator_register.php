<?php
require_once 'api/tukue_creator_functions.php';

$creator_name = $_POST[ 'creator_name' ];
$creator_pass = password_hash( $_POST[ 'creator_pass' ], PASSWORD_DEFAULT, array(
		'cost' => 11
) );

register_Creator( $creator_name, $creator_pass );

header( "location: ../../create/index.php" );
?>