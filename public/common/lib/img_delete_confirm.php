<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<!--
	未完成：全部完成しだいやります。

-->
<?php

	foreach ($_POST['delete_f'] as $value => $key){
		$img_names = strpos($key, 'front');
		if($img_names == null){
			$img_names = strpos($key, 'back');
		}
		echo '<p><img src="' . $key . '" width="20%"></p>';
		echo substr($key, $img_names);
		$img_delete = array(
			$value => $key,
		);
	}
	var_dump($img_delete);

?>
<p>を削除します、よろしいですか？</p>
<form action="img_delete.php" method="post">
	<input type="hidden" name="img_delete" value=<?php echo $img_delete ?>>
	<input type="submit" value="OK" name="delete_submit">
</form>
</body>
</html>