<?php
	include 'Sql_Checker.php';

	function Img_Register($mysqli, $img_front_flag) {
		/*
		 * 画像を登録する
		 */
		if($img_front_flag == 1) {
			//true(画像は表)
			$query = "INSERT INTO t_image(img_id, img_path, img_front_flag) VALUES(null, '" . $creator_name . "', 1)";
		}else{
			$query = "INSERT INTO t_image(img_id, img_path, img_front_flag) VALUES(null, '" . $creator_name . "', 0)";
		}
		sql($mysqli, $query);
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

		if($img_front_flag_update_flag == 1) {
			$query = "UPDATE t_image set img_front_flag = " . $img_front_flag_update . " where img_id = " . $img_id . "";
			sql($mysqli, $query);
		}
	}

	function Img_Delete($mysqli, $img_id, $img_delete_flag) {
		/*
		 * 画像削除用
		 * $mysqli = オブジェクト
		 * $img_id = 画像のid
		 * $img_delete_flag = 画像を消すときのチェックフラグcheckboxにチェックがあればtrueで1があるはずです。
		 */

		If($img_delete_flag == 1) {
			$query = "DELETE FROM t_image WHERE img_id = " . $img_id . "";
			sql($mysqli, $query);
		}
	}

	function Img_View($mysqli){
		/*
		 * 画像表示
		 */

		$query = "SELECT * FROM t_image";
		$result = sql($mysqli, $query);

		while($row = $result->fetch_assoc()){
			echo 'img_id：' . $row['img_id'] . '<br />';
			echo 'img_path：<img src=' . $row['img_path'] . '><br />';
			echo 'img_path：' . $row['img_path'] . '<br />';
			echo 'img_front_flag：' . $row['img_front_flag'] . '<br />';
		}
	}