<?php

require_once 'define.php';

function connect () {
	$mysqli = new mysqli(dbServer, dbUser, dbPass, dbName);

	if(!$mysqli) {
		die("Can not connect" . dbServer . " : " . mysqli_error());
	}
	return $mysqli;
}