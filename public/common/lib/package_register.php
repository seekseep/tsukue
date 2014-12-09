<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
<h1>登録ページ</h1>
<form action="confirm.php" method="post" enctype="MULTIPART/FORM-DATA">

<p>
・画像１表<br />
<input type="file" name="img_front[]"><br />
・画像１裏<br />
<input type="file" name="img_back[]"><br />
</p>
<!--
<p>
・画像２表<br />
<input type="file" name="img_front[]"><br />
・画像２裏<br />
<input type="file" name="img_back[]"><br />
</p>

<p>
・画像３表<br />
<input type="file" name="img_front[]"><br />
・画像３裏<br />
<input type="file" name="img_back[]"><br />
</p>

<p>
・画像４表<br />
<input type="file" name="img_front[]"><br />
・画像４裏<br />
<input type="file" name="img_back[]"><br />
</p>
<p>
・画像５表<br />
<input type="file" name="img_front[]"><br />
・画像５裏<br />
<input type="file" name="img_back[]"><br />
</p>
-->
<input type="submit" name="doSubmit" value="アップロード" />
</form>

<?php

?>

<br /><a href="index.php">戻る</a>
</body>
</html>
