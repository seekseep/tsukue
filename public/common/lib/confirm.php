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
		require 'functions.php';

		mb_language("Japanese");

		$front_all_img = 0;
		$front_posts_img = 0;
		$back_all_img = 0;
		$back_posts_img = 0;

		$tmp_dir = '../tmp/';

		if(!isset($_SESSION['pkg_name'])){
			$_SESSION['pkg_name']  = mkdir_time() . microtime(true);
		}

		$tmp_dir .= $_SESSION['pkg_name'];
		$tmp_dir = Encoding_conversion($tmp_dir);

		// $zip = $_FILES['zip'];
		// $zip_type = $zip['type'];

		// if($zip_type == 'application/octet-stream'){
		// 	unzip($zip, $tmp_dir);
		// }

		make_dir($tmp_dir);

		foreach ($_FILES['img_front']['name'] as $key => $value){
			if($value != ''){
				$front_all_img += 1;
				$front_posts_img += 1;
			}else{
				$front_all_img += 1;
			}
		}
		foreach ($_FILES['img_back']['name'] as $key => $value){
			if($value != ''){
				$back_all_img += 1;
				$back_posts_img += 1;
			}else{
				$back_all_img += 1;
			}
		}

		if($front_all_img == $front_posts_img && $back_all_img == $back_posts_img){
			$gazo_front = $_FILES['img_front'];
			confirm_img_front($gazo_front, $tmp_dir);
			$gazo_back = $_FILES['img_back'];
			confirm_img_back($gazo_back, $tmp_dir);
			img_disp($tmp_dir);
			file_write($tmp_dir);
			echo '<br />';
			echo '<br /> これでいいですか？';
			?>
<form action="end_confirm.php">
	<input type="submit" value="OK">
</form>
			<?php
		}else{
			echo '画像が選択されていません <br />';
		}

	?>


</body>
</html>
