<?php
	require_once 'Sql_Checker.php';

	function getImaga_path ( $img_id ) {

		require_once 'Sql_Checker.php';
		require_once 'database.php';

		$mysqli = connect();

		$query = "SELECT img_path FROM t_img";
		$result = sql( $mysqli, $query );

		$img_path = array();

		while( $row = $result->fetch_assoc() ) {
			$img_path[] = $row;
		}
		$result->free();
		mysqli_close( $mysqli );

		return $img_path;
	}

	function getImage_id() {
		require_once 'Sql_Checker.php';
		require_once 'database.php';

		$mysqli = connect();

		$query = "SELECT img_id FROM t_img";
		$result = sql( $mysqli, $query );

		$img_id = array();

		while( $row = $result -> fetch_assoc() ) {
			$img_id[] = $row;
		}
		$result -> free();
		mysqli_close( $mysqli );

		return $img_id;
	}

	function Img_Path_Update($mysqli, $img_id, $img_path_update, $img_path_update_flag) {
		/*
		 * (管理用？)
		 * 画像情報を変更する
		 * $mysqli = オブジェクト
		 * $img_id = 画像のid
		 * $img_path_udpate = 変更後の画像のパス
		 * $img_path_update_flag = 変更フラグ
		 *
		*/

		require_once 'Sql_Checker.php';
		require_once 'database.php';

		$mysqli = connect();

		if($img_path_update_flag == 1){
			$query = "UPDATE t_image set img_path = '" . $img_path_update . "' where img_id = " . $img_id . "";
			sql($mysqli, $query);
		}
	}

	function Img_Front_Flag_Update($mysqli, $img_id, $img_front_flag_update, $img_front_flag_update_flag) {
		/*
		 * DBにある画像の表・裏のフラグの値を変える関数(訂正用？)
		 * 表と思ったら裏だった！時などの表・裏の訂正を行う時に使う
		 * $mysqli = オブジェクト
		 * $img_id = なにかで取得したであろうimgのid
		 * $img_front_flag_update = 1(表), 0(裏)の変更後の値
		 * $img_front_flag_update_flag = checkboxで取得した変更するかどうかのフラグ
		 */

		require_once 'Sql_Checker.php';
		require_once 'database.php';

		$mysqli = connect();

		if($img_front_flag_update_flag == 1) {
			$query = "UPDATE t_image set img_front_flag = " . $img_front_flag_update . " where img_id = " . $img_id . "";
			sql($mysqli, $query);
		}
	}

	function imaga_Register () {

	}
	function Img_Delete($mysqli, $img_id, $img_delete_flag) {
		/*
		 * 画像削除用
		 * $mysqli = オブジェクト
		 * $img_id = 画像のid
		 * $img_delete_flag = 画像を消すときのチェックフラグcheckboxにチェックがあればtrueで1があるはずです。
		 */

		require_once 'Sql_Checker.php';
		require_once 'database.php';

		$mysqli = connect();

		If($img_delete_flag == 1) {
			$query = "DELETE FROM t_image WHERE img_id = " . $img_id . "";
			sql($mysqli, $query);
		}
	}
?>