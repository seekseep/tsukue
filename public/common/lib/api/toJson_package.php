<?php

function toJson_packageData ( $package_id ) {
	require_once 'tukue_package_functions.php';
	require_once 'tukue_img_functions.php';
	require_once 'tukue_object_functions.php';
	require_once 'tukue_creator_functions.php';

	$results = array();
	$images = array();

	$package = detail( $package_id );
	$image_id = getObject_id( $package[ 0 ][ "package_id" ] );

	foreach ( $package as $key => $pack ) {

		$package_image = getImaga_path( $pack[ "package_img" ] );
		$package_fieldbg = getImaga_path( $pack[ "package_fieldbg" ] );
		$package_handbg = getImaga_path( $pack[ "package_handbg" ] );
		$package_f_img = getImaga_path( $image_id[ 0 ][ "f_img_id" ] );
		$package_b_img = getImaga_path( $image_id[ 0 ][ "b_img_id" ] );

		$results = array(
				"id" => $pack[ "package_id" ],
				"name" => $pack[ "package_name" ],
				"description" => $pack[ "package_description" ],
				"image" => $pack[ "package_img" ],
				"author" => array(
						"name" => creator_toName( $pack[ "creator_id" ] )
				),
				"table" => array(
						"width" => 2000,
						"height" => 2000,
						"image" => $package_fieldbg
				),
				"hand" => array(
						"width" => 2000,
						"height" => 2000,
						"image" => $package_handbg
				),
				"card" => array(
						"width" => 2000,
						"height" => 2000,
						"default" => array(
								"front" => $package_f_img,
								"back" => $package_b_img
						),
						"list" => array()
				)
		);
	}
	foreach ( $image_id as $key => $img ) {

		if ( isset( $img[ "f_img_id" ] ) ) {
			// $img[ "f_img_id" ] に値があれば連想配列に入れる

			$f_img = getImaga_path( $img[ "f_img_id" ] );
			$b_img = getImaga_path( $img[ "b_img_id" ] );
			$results[ "card" ][ "list" ][] = array(
					"front" => $f_img,
					"back" => $b_img,
			);
		}
	}

	echo "<pre>";
	var_dump( json_encode( $results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) );
}