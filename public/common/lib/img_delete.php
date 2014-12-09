<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>


<?php

	var_dump($_POST['delete_f']);
	foreach ($_POST['delete_f'] as $value => $key){
		unlink($key);
	}



?>


</body>
</html>