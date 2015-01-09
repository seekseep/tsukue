W<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />

<style type="text/css">
label, input, textarea {
	display: block;
	width: 400px;
	fload: left;
	margin-bottom: 10px;
}

label {
	text-align: right;
	padding-right: 15px;
}
</style>
</head>

<body>

	<?php session_start(); ?>
	<h1>登録ページ</h1>
	<form action="confirm.php" method="post" enctype="MULTIPART/FORM-DATA">

		<p>アップロードしたい画像ファイル(gif, jpg, png )を指定してください。</p>
		<p>
			・画像１表<br /> <input type="file" name="front[]"><br /> ・画像１裏<br /> <input
				type="file" name="back[]"><br />
		</p>

		<p>
			・画像２表<br /> <input type="file" name="front[]"><br /> ・画像２裏<br /> <input
				type="file" name="back[]"><br />
		</p>
		<!--
		<p>
		・画像３表<br />
		<input type="file" name="front[]"><br />
		・画像３裏<br />
		<input type="file" name="back[]"><br />
	</p>
-->
		パッケージ名：<input type="text" name="package_name"> パッケージの詳細：
		<textarea name="package_description" rows="3" cols=""></textarea>
		タグ：<input type="text" name="package_tag"> パッケージのアイコン：<input
			type="file" name="package_image"> 場の背景：<input type="file"
			name="package_fieldbg"> 手札の背景：<input type="file"
			name="package_handbg">

		<!--
<p>
・画像４表<br />
<input type="file" name="front[]"><br />
・画像４裏<br />
<input type="file" name="back[]"><br />
</p>
<p>
・画像５表<br />
<input type="file" name="front[]"><br />
・画像５裏<br />
<input type="file" name="back[]"><br />
</p>
-->
		<input type="submit" name="doSubmit" value="アップロード" />
	</form>

<?php

?>

<br />
	<a href="index.php">戻る</a>
</body>
</html>
