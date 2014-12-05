<?php

define("dbServer", "localhost");
define("dbUser", "root");
define("dbPass", "");
define("dbName", "tukue");

$mysqli = new mysqli(dbServer, dbUser, dbPass, dbName);

// if($mysqli->connect_errno){
// 	die('Connect Error (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
// }