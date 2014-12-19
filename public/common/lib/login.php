<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
</head>
<body>

<h1>index</h1>

<?php

error_reporting(-1);

session_start();

unset($_SESSION['username']);

session_destroy();
?>

<form action="login_check.php" method="POST">
<p><label>ID:<input type="text" name="name"></label></p>
<p><label>PassWord:<input type="password" name="pass"></label></p>
<p><input type="submit" value="送信"></p>
</form>

</body>
</html>
