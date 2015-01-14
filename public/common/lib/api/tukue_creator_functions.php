<?php

function register_Creator ( $creator_name, $creator_pass )
{
    require_once 'Sql_Checker.php';
    require_once 'database.php';
    /*
     * ユーザ(クリエイター)を作成する時に使う関数 ユーザIDとユーザ名をDBにinsertする 引数：$mysqli =
     * database.phpで接続したときにオブジェクトが入ってる $creator_name = isnert.phpから
     */

    $mysqli = connect();

    $query = "INSERT INTO t_creator(creator_id, creator_name, creator_pass ) VALUES(null, '" .
             $creator_name . "', '" . $creator_pass . "')";
    sql( $mysqli, $query );
}

function creator_toName ( $creator_id ) {
	require_once 'Sql_Checker.php';
	require_once 'database.php';

	$mysqli = connect();

	$query = "SELECT creator_name FROM t_creator WHERE creator_id = '" .
			$creator_id . "'";
	$result = sql( $mysqli, $query );

	while ( $row = mysqli_fetch_array( $result ) ) {
		return $row[ 'creator_name' ];

	}
}
function updates_Creator ( $creator_id )
{
    require_once 'Sql_Checker.php';
    require_once 'database.php';
    $mysqli = connect();

    /*
     * ユーザ(クリエイター)情報を変更するときに使う ユーザ名変更時DBのデータを変更する
     */
    $query = "UPDATE t_creator set creator_name = '" . $creator_name .
             "' where creator_id = '" . $creator_id . "'";
    sql( $mysqli, $query );
}

function get_CreatorName ( $creator_name )
{

    /*
     * 引数をもとにデータベースにある確認するために使用
     */
    require_once 'Sql_Checker.php';
    require_once 'database.php';

    $mysqli = connect();

    $query = "SELECT creator_name FROM t_creator WHERE creator_name = '" .
             $creator_name . "'";
    $result = sql( $mysqli, $query );

    while ( $row = mysqli_fetch_array( $result ) ) {
        return $row[ 'creator_name' ];
    }
}

function get_CreatorPass ( $creator_name )
{
    /*
     * 引数をもとに、creator_passをもってくる
     */
    require_once 'Sql_Checker.php';
    require_once 'database.php';

    $mysqli = connect();

    $query = "SELECT creator_pass FROM t_creator WHERE creator_name = '" .
             $creator_name . "'";

    $result = sql( $mysqli, $query );

    while ( $row = $result->fetch_assoc() ) {
        $creator_pass[] = $row;
    }
    return $creator_pass[ 0 ][ 'creator_pass' ];
}

function getCreator_id ( $creator_name )
{

    /*
     * 引数をもとにcreator_idを持ってくる
     */
    require_once 'Sql_Checker.php';
    require_once 'database.php';

    $mysqli = connect();

    $query = "SELECT creator_id FROM t_creator WHERE creator_name = '" .
             $creator_name . "'";
    $result = sql( $mysqli, $query );

    while ( $row = mysqli_fetch_array( $result ) ) {
        return $row[ 'creator_id' ];
    }
}

function Creator_Delete ( $creator_delete_flag, $creator_id )
{
    include 'Sql_Checker.php';
    /*
     * ユーザの削除時にDBにあるデータを削除する関数 delete で削除する 引数：$mysqli =
     * database.phpでオブジェクトを持っている $creator_delete_flag =
     * 削除するチェックでチェックされていて????関数でtrueがはいっている $creator_id =
     * ????関数で登録するユーザのIDを取得している
     */

    if ( $creator_delete_flag == true ) {
        // 削除するにチェックがある
        $query = "DELETE FROM t_creator WHERE creator_id = '" . $creator_id . "'";
        sql( $query );
    }
}
?>