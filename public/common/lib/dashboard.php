<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>

<body>
<h1>ダッシュボード</h1>

<?php

	session_start();

	$username = $_SESSION['username'];

	if($username != null) {
		echo '<p>' . $username . 'さんようこそ</p>';
		echo '<a href="logout.php">ログアウト</a><br />';
	}else {
		echo 'ログインしてください<br />';
	}
?>

<p><a href="input_data.php">目標２</a></p>
<p><a href="index.php">TOPページ</a></p>
<p><a href="test.php">テストページ</a></p>

</body>

</html>
