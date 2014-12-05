<?php

<<<<<<< HEAD
define("dbServer", "dev.kinako.asia:3307");
=======
define("dbServer", "dev.kinako.asia");
>>>>>>> 4a04c157286f8994e672621e85746a92221eead4
define("dbUser", "root");
define("dbPass", "");
define("dbName", "trump_test");

$mysqli = new mysqli(dbServer, dbUser, dbPass, dbName);

// if($mysqli->connect_errno){
// 	die('Connect Error (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
// }
