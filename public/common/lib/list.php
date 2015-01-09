<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
	<h1>パッケージを一覧表示する</h1>
<?php
session_start();
require_once 'api/tukue_package_functions.php';
require_once 'api/tukue_creator_functions.php';
require_once 'api/functions.php';

if ( isset( $_SESSION[ 'creator_name' ] ) ) {
	$creator_name = $_SESSION[ 'creator_name' ];

	$package_date = getPackagedate( $creator_name );

	foreach ( $package_date as $key => $val ) {

		$package_name = $package_date[ $key ][ 'package_name' ];
		$date = date_create( $package_date[ $key ][ 'package_time' ] );
		$date = date_format( $date, 'Y-m-d-H-i-s' );
		openDirectory( $date, $package_name );
	}
} else {
	echo 'ログインしてください。<br />';
	echo "<input type='button' onclick='history.back()' value='戻る'' />";
}

?>
</body>
</html>