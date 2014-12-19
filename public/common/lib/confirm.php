<!--
 * 確認画面
-->

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
	<?php
		session_start();

		require_once 'api/functions.php';

		uploaded_confirm_img( $_FILES['front'] );
		uploaded_confirm_img( $_FILES['back'] );
		uploaded_confirm_img($data)

?>
<form action="end_confirm.php">
	<input type="submit" value="OK">
</form>
</body>
</html>