<!--
2015/01/12/23:59現在
登録処理のfunctionに取得データを投げ返ってきた値( true or false )でecho 内容を変えているPHP
-->

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
</head>

<body>
	<?php

	/**
	 * package_registerの引数について
	 *
	 * @param $_FILES :
	 *        	場の背景、手札の背景など画像オブジェクトが格納されている
	 * @param $_POST :
	 *        	パッケージ名などテキストが格納されている
	 * @param $_SESSION[ '(creator_name'
	 *        	] : ログイン中のユーザ名が格納されている
	 */

	session_start(); // ログイン中のユーザ名を取得するために、セッションを開始する

	require_once 'api/functions.php'; // 登録処理のfunctions.phpの呼び出し

	$result = package_register( $_FILES, $_POST, $_SESSION[ 'creator_name' ] ); // パッケージ登録する処理をfunctions.phpのpackage_registerに投げる

	var_dump( $result );
	if( $result != true ) {
		echo $result;
	}
// 	if ( $result == true ) { // 登録できたら
// 		echo "登録できました。<br />";
// 		echo "<a href='../../create/index.php'>TOPページへ</a><br />";
// 		echo "<a href='../../create/dashboard.php'>ダッシュボードへ</a>";
// 	} else { // 登録に失敗したら
// 		echo "登録失敗しました。再度登録し直して下さい。<br />";
// 		echo "<a href='../../create/add.php'>再度登録する</a>";
// 	}
	?>

</body>
</html>
