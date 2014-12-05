<?php

	function Creator_Register($creator_name){
		include 'database.php';
		include 'Sql_Checker.php';
		/*
		 * ユーザ(クリエイター)を作成する時に使う関数
		 * ユーザIDとユーザ名をDBにinsertする
		 *
		 * 引数：$mysqli = database.phpで接続したときにオブジェクトが入ってる
		 *       $creator_name = isnert.phpから
		 */
		$query = "INSERT INTO t_creator(creator_id, creator_name) VALUES(null, '" . $creator_name . "')";
		sql($query);
	}

	function Creator_Updates($creator_id){
		include 'database.php';
		include 'Sql_Checker.php';
		/*
		 * ユーザ(クリエイター)情報を変更するときに使う
		 * ユーザ名変更時DBのデータを変更する
		 */
		$query = "UPDATE t_creator set creator_name = '" . $creator_name . "' where creator_id = '" . $creator_id . "'";
		sql($query);
	}

	function Get_CreatorName($creator_name) {
		include 'database.php';
		include 'Sql_Checker.php';
		/*
		 * ユーザ(クリエイター)の引数をもとにSELECTする
		 * 引数に代入されたユーザがデータベースにあるなら名前が返却
		 * DBになければNULLが返却
		 */
		$query = "SELECT creator_name FROM t_creator WHERE creator_name = '" . $creator_name . "'";
		$result = sql($mysqli, $query);

		while($row = mysqli_fetch_array($result)){
			 return $row['creator_name'];
		}
	}

	function Get_CreatorId($creator_name) {
		include_once 'database.php';
		include_once 'Sql_Checker.php';
		/*
		 * ユーザ(クリエイター)の一覧を持ってくる
		* 現在すべてのユーザ(クリエイター)を表示するので、今後
		* 変えていく
		*
		*/
		$query = "SELECT creator_id FROM t_creator WHERE creator_name = '" . $creator_name . "'";
		$result = sql($mysqli, $query);

		while($row = mysqli_fetch_array($result)){
			return $row['creator_id'];
		}
	}

	function Creator_Delete($creator_delete_flag, $creator_id) {
		include 'database.php';
		include 'Sql_Checker.php';
		/*
		 * ユーザの削除時にDBにあるデータを削除する関数
		 * delete で削除する
		 * 引数：$mysqli = database.phpでオブジェクトを持っている
		 *       $creator_delete_flag = 削除するチェックでチェックされていて????関数でtrueがはいっている
		 *       $creator_id = ????関数で登録するユーザのIDを取得している
		 */

		if($creator_delete_flag == true) {
			//削除するにチェックがある
			$query = "DELETE FROM t_creator WHERE creator_id = '" . $creator_id . "'";
			sql($query);
		}
	}
	?>