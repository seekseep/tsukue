<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>

<form action="updates.php" method="post">
	<p><input type="text" name="creator_name"></p>
	<input type="submit" value="変更">
</form>

<?php
	require_once 'database.php';
	require_once 'tukue_creator_functions.php';
	creator_view($mysqli);
?>
</body>
</html>