<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
<h1>パッケージを一覧表示する</h1>
<?php

	$d = dir("../package/");

	while(false !== ($entry = $d->read())){
		$entry = mb_convert_encoding($entry, "UTF-8", "cp932");

		if($entry != "." && $entry != "..") {
			echo "<a href='" . "view.php?pack=" . $entry . "'>". $entry . "</a><br />";
		}
	}
	$d->close();
?>


<br />
<form >
	<input type="button" onclick="history.back()" value="戻る" />
</form>
</body>
</html>
