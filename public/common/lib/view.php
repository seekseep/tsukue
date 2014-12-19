<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
<h1>パッケージの中身を表示</h1>
</body>
</html>


<?php
	require_once 'functions.php';
	require_once 'api/tukue_package_functions.php';
	require_once 'api/tukue_creator_functions.php';


	echo "<p>削除する画像を選んで下のボタンを押してください。</p>";

	$package_name = $_GET['package'];
	$creator_id = get_CreatorId( 'test' );

	$path = getPath( $creator_id, $package_name );

	if(is_dir( $path ) ){
		$files = scandir( $path );
		foreach ( $files as $key => $val ){
			if($val != "." && $val != ".."){
				echo "<p>" . $val . "を削除する<br />";
				echo "<img src='" . ( $path . "/" . $val ) . "' width='30%' height='30%'>";
			}
		}
	} else {
		echo $path . 'はディレクトリではない';
	}
	?>
