<?php header( 'Content-Type:text/css; charset=utf-8' ); ?>
<?php


function toCSS ( $package_id ) {
	require_once 'tukue_object_functions.php';
	require_once 'tukue_package_functions.php';
	require_once 'tukue_img_functions.php';

	$object = get_fcards( $package_id );

	foreach ( $object as $key => $card_id ) {
		$object_id = $card_id[ "object_id" ];
		$f_img_path = getImaga_path( $card_id[ "f_img_id" ] );
		$b_img_path = getImaga_path( $card_id[ "b_img_id" ] );
		?>

<?php
		echo "
.card[data-front='true'][data-id='" . $object_id . "'] {
	background-image: url(" . $f_img_path . ")
}";
		echo "
.card[data-front='false'][data-id='" . $object_id . "'] {
	background-image: url(" . $b_img_path . ")
}";
		?>
<?php
	}
}
?>