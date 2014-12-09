<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="refresh" content="2;index.php">
</head>
<body>


<?php
	session_start();
	require 'functions.php';

	$tmp_dir = '../tmp/';
	$dir = '../package/';

	$tmp_dir .= $_SESSION['pkg_name'];
	$dir .= $_SESSION['pkg_name'];

	make_dir($dir);

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

	if(is_dir($tmp_dir)){
		if($dh = opendir($tmp_dir)){
				while(($file = readdir($dh)) !== false) {
					if($file != ".." && $file != "."){
						if(is_dir($tmp_dir . '/' . $file) != true){
							rename($tmp_dir .'/' . $file, $dir . '/' . $file);
					}
				}
			}
			rmdir($tmp_dir . '/img');
			rmdir($tmp_dir);
			closedir($dh);
		}else {
			echo 'エラー';
		}
	}
	echo '登録できました。';
	unset($_SESSION['pkg_name']);
?>
</body>
</html>
