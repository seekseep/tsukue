<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
</head>
<body>

<h1>login</h1>

<?php
session_start();
?>
<form action="login_check.php" method="POST">
	<p><label>ID:<input type="text" name="creator_name"></label></p>
	<p><label>PassWord:<input type="password" name="creator_pass"></label></p>
	<p><input type="submit" value="送信"></p>
</form>

</body>
</html>
