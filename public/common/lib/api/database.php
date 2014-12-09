<?php

define("dbServer","localhost");
define("dbUser", "tsukue");
define("dbPass", "trump");
define("dbName", "trump_test");

$mysqli = new mysqli(dbServer, dbUser, dbPass, dbName);
?>
