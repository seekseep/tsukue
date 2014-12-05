<?php

	include 'common/lib/api/tukue_package_functions.php';

	$data = $_POST['data'];

	Package_Register($data, 1);

	?>