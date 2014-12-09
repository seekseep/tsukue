<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>creator_user｜ユーザ登録</title>
</head>

<body>
	<form action="creator_user.php" method="post">
		<p><input type="text" name="creator_name"></p>
		<input type="submit" value="登録">
	</form>
	<?php
		include_once 'database.php'; //DB接続できた時の、コネクション
		include_once 'tukue_creator_functions.php'; //tukue_creator_functions.phpから関数呼び出すためにinculudeをする

		if(isset($mysqli)){
			//ある
			$creator_name = $_POST['creator_name'];
			if(creator_User($creator_name, $mysqli) == true){
				//登録できた';
			}else{
				//登録できなかった
				return false;
			}
		}else {
			//ない
			return false;
		}
	?>
</body>
</html>