<!--
* 確認画面
-->

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
	<?php
	session_start();

	require_once 'api/functions.php';
	require_once 'api/tukue_creator_functions.php';

	$creator_id = getCreator_id( $_SESSION[ 'creator_name' ] );

	$result = package_register( $_FILES, $_POST, $creator_id );

	if ( $result == true ) {
		echo "登録できました。<br />";
		echo "<a href='../../create/index.php'>TOPページへ</a>\t";
		echo "<a href='../../create/dashboard.php'>ダッシュボードへ</a>";
	} else {
		echo "登録失敗しました。<br />";
		echo "再度登録し直して下さい。";
		echo "<a href='../../create/add.php'>再度登録する</a>";
	}
	?>

</body>
</html>
