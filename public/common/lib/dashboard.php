<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>

<body>
<h1>ダッシュボード</h1>

<?php

	session_start();

	if( isset($_SESSION['creator_name']) ) {
		$creator_name = $_SESSION['creator_name'];
	}

	if( isset( $creator_name ) ) {
		echo '<p>' . $creator_name . 'さんようこそ</p>';
		echo '<a href="logout.php">ログアウト</a><br />';
	}else {
		echo "<a href='login.php'>ログイン</a>してください";
	}
?>

<p><a href="input_data.php">目標２</a></p>
<p><a href="index.php">TOPページ</a></p>
<p><a href="test.php">テストページ</a></p>

</body>

</html>
