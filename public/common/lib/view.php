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
	require 'functions.php';

	$dir = "../package/";
	$dir .= $_GET['pack'];

	echo '削除する画像を選んで下のボタンを押してください。';
	view_img_disp($dir);

	?>
