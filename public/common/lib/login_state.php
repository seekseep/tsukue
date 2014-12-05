<?php

	var_dump($_SESSION['username']);

	function login_state_check($username) {

		if(isset($username)){
		}else {
			header("location: login.php");
		}
	}
?>