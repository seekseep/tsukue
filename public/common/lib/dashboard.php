<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>

<body>
<h1>ダッシュボード</h1>

<?php

	session_start();

	var_dump($_SESSION['username']);

	$username = $_SESSION['username'];

	if($username != null) {
		echo '<p>' . $username . 'さんようこそ</p>';
		echo '<a href="logout.php">ログアウト</a>';
	}else {
		echo 'ログインしてください.';
	}
?>

<a href="input_data.php">目標２</a>

</body>

</html>