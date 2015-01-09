<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>

<body>
	<?php
	session_start();

	require_once 'functions.php';
	require_once 'api/tukue_package_functions.php';
	require_once 'api/tukue_creator_functions.php';

	$username = "";
	if( isset( $_SESSION['username']) ) {
		$username = $_SESSION['username'];
	}

	$userid = Get_CreatorId($username);

	$tmp_dir = '../tmp/';
	$dir = '../package/';

	$tmp_dir .= $_SESSION['pkg_name'];
	$dir .= $_SESSION['pkg_name'];

	make_dir($dir);

	Package_Register($_SESSION['pkg_name'], $userid, $dir);

	if (is_dir($tmp_dir) . '/img/') {
		if ($dh = opendir($tmp_dir . '/img/')) {
			while (($file = readdir($dh)) !== false) {
				if($file != ".." && $file != "."){
					if(!is_dir($tmp_dir . '/img/' . $file)){
						rename($tmp_dir . '/img/' . $file, $dir . '/img/' . $file);
					}
				}
			}
			closedir($dh);
		}
	}

	var_dump( $tmp_dir );

	if(is_dir($tmp_dir)){
		if($dh = opendir($tmp_dir)){
			while(($file = readdir($dh)) !== false) {
				if($file != ".." && $file != "."){
					if(is_dir($tmp_dir . '/' . $file) != true){
						rename($tmp_dir .'/' . $file, $dir . '/' . $file);
					}
				}
			}

			if($tmp_dir != "../tmp/") {
				rmdir($tmp_dir . '/img');
				rmdir($tmp_dir);
			}
			closedir($dh);
		}else {
			echo 'エラー';
		}
	}
	// 	Package_Register(, $creator_id, $dir_path)
	echo '登録できました。';
	unset($_SESSION['pkg_name']);
	?>
</body>
</html>
