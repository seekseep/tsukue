<?php

function sql($mysqli, $query) {

	if(isset($mysqli)) {
		//ある
		if($mysqli->set_charset("UTF8")){
			//エンコード成功
			if($result = $mysqli->query($query)){
				//SQL実行成功
 				return $result;
			}else {
				//SQL実行失敗
				return false;
			}
		}else {
			//エンコード失敗
			return false;
		}
	}else {
		//ない
		return false;
	}
	$result->close();
	mysqli_close($mysqli);
}