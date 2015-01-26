<?php

function get_fcards ( $package_id ) {
	require_once 'Sql_Checker.php';
	require_once 'database.php';

	$mysqli = connect();

	$query = "SELECT object_id, f_img_id, b_img_id FROM t_object WHERE package_id = '" . $package_id . "'";
	$result = sql( $mysqli, $query );

	$img_id = array();

	while ( $row = $result -> fetch_assoc() ) {
		$img_id[] = $row;
	}

	$result -> free();
	$mysqli -> close();

	return $img_id;
}

function getObject_id ( $package_id ) {
	require_once 'Sql_Checker.php';
	require_once 'database.php';

	$mysqli = connect();

	$query = "SELECT f_img_id, b_img_id FROM t_object WHERE package_id = '" . $package_id . "'";
	$result = sql( $mysqli, $query );

	$img_id = array();
	while ( $row = $result -> fetch_assoc() ) {
		$img_id[] = $row;
	}

	$result -> free();
	$mysqli -> close();

	return $img_id;
}

function Object_Register ( $package_id, $f_img_flag, $b_img_id ) {
	/*
	 * オブジェクト(画像)を登録するときに使う
	 */
	require_once 'database.php';
	require_once 'tukue_package_functions.php';

	$mysqli = connect();

	if( $b_img_id != null ) {
	$query = "INSERT INTO t_object(object_id, package_id, f_img_id, b_img_id ) VALUES(null, " . $package_id . ", " . $f_img_flag . ", " . $b_img_id .
			 ")";
	} else if ( $b_img_id == null ) {
		$query = "INSERT INTO t_object(object_id, package_id, f_img_id ) VALUES(null, " . $package_id . ", " . $f_img_flag . ")";
	}
	print_r( $query );
	$result = sql( $mysqli, $query );

	return $result;

	$result -> free();
	$mysqli -> close();
}

function Object_Delete ( $mysqli, $object_delete_flag ) {
	/*
	 * オブジェクトの削除を行う関数
	 */
	if ( $object_delete_flag == true ) {
		$query = "DELETE FROM t_object WHERE ";
	}
}
