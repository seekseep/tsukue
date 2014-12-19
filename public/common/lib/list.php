<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
<h1>パッケージを一覧表示する</h1>
<?php

	require_once 'api/tukue_package_functions.php';
	require_once 'api/tukue_creator_functions.php';

	$username = $_SESSION['username'];
	$creator_id = get_CreatorId( $username );
	$pathData =getPath( $creator_id );

	foreach ($pathData as $key => $val ) {
		echo "<p><a href='view.php?pack=" . $val . "'>" . $key . "</a></p>";
	}
?>


<br />
<form >
	<input type="button" onclick="history.back()" value="戻る" />
</form>
</body>
</html>
