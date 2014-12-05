<?php

	function creator_id_check($creator_id){
		include 'database.php';
		include 'Sql_Checker.php';
		/*
		 * ログイン中のcreator_idが存在するかチェック
		* $mysqli = database.phpでオブジェクトを取得済み
		* $creator_id = ????関数でログイン中のcreatorのidを取得済み
		*/
		//$creator_id = ????関数で呼び出された値を代入
		$query ="SELECT creator_id from t_creator where creator_id = '" . $creator_id . "'";
		$result = sql($mysqli, $query);

		while($row = mysqli_fetch_assoc($result)){
			return ($row['creator_id']);
		}
	}

	function  Package_Register($package_name, $creator_id){
		include 'database.php';
		include 'Sql_Checker.php';
		/*
		 * Package登録時に使う関数
		 * package登録時DBに情報を保存する
		 * 保存内容:PackcageID, Packcage_Name, Creator_ID
		 * 引数：$mysqli = database.phpでオブジェクトを持っている
		 *       $package_name = ????関数でpackageの名前を取得している
		 *       $creator_id = ????関数でcreatorのidを取得している
		 */

		$query = "INSERT INTO t_package(package_id, package_name, creator_id) VALUES(null, '" . $package_name . "', '" . creator_id_check($creator_id) ."')";
		sql($mysqli, $query);
	}

	function Package_Updates($package_id, $package_name){
		include 'database.php';
		include 'Sql_Checker.php';
		/*
		 * packageの名前を変えるときに使う関数
		 * 引数：$mysqli = database.phpでオブジェクトを持っている
		 *       $package_id = packageのidを持っている
		 *       $package_name = 変更後のpackageの名前を持っている
		 */

		$query = "UPDATE t_package set package_name = '" . $package_name . "' WHERE package_id = '" . $package_id ."'";
		sql($mysqli, $query);
	}

 	function Package_View ($creator_id) {
		/*
		 * packageの一覧で使う関数です
		 * 引数：$mysqli = database.phpでオブジェクトを持つ
		 *       $creator_id = ????関数でcreatorのidを取得済み
		 */

 		include_once 'database.php';
 		include_once 'Sql_Checker.php';

		creator_id_check($creator_id);

		$query = "SELECT package_name FROM t_package WHERE creator_id = '" . $creator_id . "'";
		$result = sql($mysqli, $query);
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			echo "パッケージ名：" . $row['package_name'] . "<br />";
		}
	}

	function Package_Delete($package_delete_flag, $package_id) {

		/*
		 * packageの削除で使う関数です
		 * 引数：$mysqli = database.phpでオブジェクトを持つ
		 *       $package_delete_flag = 削除するチェックでチェックされていて????関数でtrueがはいっているs
		 *       $package_id = ????関数でpackageのidを取得済み
		 */

	include 'Sql_Checker.php';
	include 'database.php';
		if($creator_delete_flag == true) {
			//フラグがある
			$query = "DELETE FROM t_package WHERE package_id = '" . $package_id . "'";
			sql($mysqli, $query);
		}else{
			//フラグがない
			return false;
		}
	}
?>