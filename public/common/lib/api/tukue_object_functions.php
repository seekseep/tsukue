<?php
	include 'Sql_Checker.php';

	function Object_Register($mysqli, $package_id, $f_img_flag, $b_img_id, $package_num){
		/*
		 * オブジェクト(画像)を登録するときに使う
		 *
		 */

		$query = "INSERT INTO t_object(object_id, package_id, f_img_id, b_img_id, package_num) VALUES(null, '" . $package_id . "', '" . $f_img_flag ."', '" . $b_img_id . "', '" . $package_num ."')";
		sql($mysqli, $query);
	}

	function Object_View($mysqli) {
		/*
		 * オブジェクトテーブルの中身を表示するs
		 *
		 */
		$query = "SELECT * FROM t_object";
		$result = sql($mysqli, $query);
		while($row = mysqli_fetch_assoc($result)){
			echo "オブジェクトID：" . $row['object_id'] . "<br />";
			echo "パッケージID：" . $row['package_id'] . "<br />";
			echo "画像（表）:" . $row['f_img_id'] . "<br />";
			echo "画像（裏）" . $row['b_img_id'] . "<br />";
			echo "パッケージ内番号：" . $row['package_num'] . "<br />";
		}
	}

	function Object_Delete($mysqli, $object_delete_flag) {
		/*
		 * オブジェクトの削除を行う関数
		 */



		if($object_delete_flag == true) {
			$query = "DELETE FROM t_object WHERE ";
		}
	}