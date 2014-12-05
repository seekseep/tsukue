<?php

define("dbServer", "dev.kinako.asia");
define("dbUser", "root");
define("dbPass", "");
define("dbName", "trump_test");

$mysqli = new mysqli(dbServer, dbUser, dbPass, dbName);

// if($mysqli->connect_errno){
// 	die('Connect Error (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
// }
