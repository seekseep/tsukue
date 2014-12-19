<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
</head>

<body>

<?php

	session_start();

	require_once ('common/lib/api/tukue_creator_functions.php');
	$Creator_Id = Get_CreatorId($_SESSION['username']);

	require_once ('common/lib/api/tukue_package_functions.php');
	$test = Package_View($Creator_Id);


?>
</body>
</html>