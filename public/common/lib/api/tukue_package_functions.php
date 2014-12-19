<?php

	function getPackage_id() {
		require_once 'Sql_Checker.php';
		require_once 'database.php';

		$mysqli = connect();
		$query = "SELECT package_id FROM t_package";
		$result = sql( $mysqli, $query );

		$package_id = array();

		while( $row = $result -> fetch_assoc() ){
			$package_id[] = $row;
		}
		$result -> free();
		mysqli_close ( $mysqli );

		return $package_id;
	}

	function showPackages ( $creator_id ) {
		/*
		 * t_packageにある項目全てをcreator_idと同じのだけを返す
		*/
		require_once 'Sql_Checker.php';
		require_once 'database.php';
		require_once 'tukue_creator_functions.php';

		$mysqli = connect();

		$query = "SELECT package_id FROM t_package WHERE creator_id = '" . $creator_id . "'";
		$result = sql( $mysqli, $query );

		$package_id = array();

		while( $row = $result->fetch_assoc() ) {
			$package_id[] = $row;
		}
		$result->free();
		mysqli_close( $mysqli );

		return $package_id;
	}

	function creator_id_check($creator_id){
		require_once 'Sql_Checker.php';
		require_once 'database.php';
		/*
		 * ログイン中のcreator_idが存在するかチェック
		* $mysqli = database.phpでオブジェクトを取得済み
		* $creator_id = ????関数でログイン中のcreatorのidを取得済み
		*/
		//$creator_id = ????関数で呼び出された値を代入
		$mysqli = connect();

		$query ="SELECT creator_id from t_creator where creator_id = '" . $creator_id . "'";
		$result = sql($mysqli, $query);

		while($row = mysqli_fetch_assoc($result)){
			return ($row['creator_id']);
		}
		$result->close();
		mysqli_close($mysqli);
	}

	function getPackage_all( $creator_id ){
		/*
		 * t_packageにある項目全てをcreator_idと同じのだけを返す
		*/
		require_once 'Sql_Checker.php';
		require_once 'database.php';

		$mysqli = connect();

		$query = "SELECT * FROM t_package WHERE creator_id = '" . $creator_id . "'";
		$result = sql( $mysqli, $query );

		$AllData = array();

		while( $row = $result->fetch_assoc() ) {
			$AllData[] = $row;
		}
		$result->free();
		mysqli_close( $mysqli );

		return $AllData;

	}

	function getPackageName ( $creator_id ) {

		/*
		 * packageのnameを返すメソッド
		*/
		require_once 'Sql_Checker.php';
		require_once 'database.php';
		require_once 'tukue_creator_functions.php';

		$mysqli = connect();

		$query = "SELECT package_name FROM t_package WHERE creator_id = '" . $creator_id . "'";
		$result = sql( $mysqli, $query );

		$NameData = array();

		while( $row = $result->fetch_assoc() ) {
			$NameData[] = $row['package_name'];
		}
		$result->free();
		mysqli_close( $mysqli );

		return $NameData;
	}

	function getPath ( $creator_id, $package_name ) {

		/*
		 * packageのpathを返すメソッド
		 */
		require_once 'Sql_Checker.php';
		require_once 'database.php';
		require_once 'tukue_creator_functions.php';

		$mysqli = connect();

		$query = "SELECT package_path FROM t_package WHERE creator_id = '" . $creator_id . "' AND package_name = '" . $package_name . "'";
		$result = sql( $mysqli, $query );

		$pathData = array();

		while( $row = $result->fetch_assoc() ) {
			$pathData = $row['package_path'];
		}
		$result->free();
		mysqli_close( $mysqli );

		return $pathData;
	}

	function Database_Package_Register( $package_name, $package_description, $creator_id, $package_time, $package_tag ){

		/*
		 * Package登録時に使う関数
		 * package登録時DBに情報を保存する
		 * 保存内容:PackcageID, Packcage_Name, Creator_ID
		 * 引数：$mysqli = database.phpでオブジェクトを持っている
		 *       $package_name = ????関数でpackageの名前を取得している
		 *       $creator_id = ????関数でcreatorのidを取得している
		 */

		require_once 'Sql_Checker.php';
		require_once 'database.php';

		$mysqli = connect();

		$query = "INSERT INTO t_package(package_id, package_name, package_description, creator_id, package_time, package_tag,) VALUES(null, '" . $package_name . "', '" . $package_description . "', '" . creator_id_check($creator_id) ."', '" . $package_time . "', '" . $package_tag . "'";
		sql($mysqli, $query);
	}

	function Package_Updates($package_id, $package_name){
		require_once 'Sql_Checker.php';
		require_once 'database.php';
		/*
		 * packageの名前を変えるときに使う関数
		 * 引数：$mysqli = database.phpでオブジェクトを持っている
		 *       $package_id = packageのidを持っている
		 *       $package_name = 変更後のpackageの名前を持っている
		 */

		$mysqli = connect();
		$query = "UPDATE t_package set package_name = '" . $package_name . "' WHERE package_id = '" . $package_id ."'";
		sql($mysqli, $query);
	}

 	function get_packageName ( $creator_id ) {
		/*
		 * packageの一覧で使う関数です
		 * 引数：$mysqli = database.phpでオブジェクトを持つ
		 *       $creator_id = ????関数でcreatorのidを取得済み
		 */

 		require_once 'Sql_Checker.php';
 		require_once 'database.php';

		creator_id_check($creator_id);

		$mysqli = connect();

		$query = "SELECT package_name FROM t_package WHERE creator_id = '" . $creator_id . "'";
		$result = sql($mysqli, $query);

		$packageName_Data = array();

		while( $row = $result->fetch_assoc() ) {
			$packageName_Data[] = $row['package_name'];
		}
		$result->free();
		mysqli_close( $mysqli );

		return $packageName_Data;
	}

	function Package_Delete($package_delete_flag, $package_id) {

		/*
		 * packageの削除で使う関数です
		 * 引数：$mysqli = database.phpでオブジェクトを持つ
		 *       $package_delete_flag = 削除するチェックでチェックされていて????関数でtrueがはいっているs
		 *       $package_id = ????関数でpackageのidを取得済み
		 */

		require_once 'Sql_Checker.php';
		require_once 'database.php';
		$mysqli = connect();

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