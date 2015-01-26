<?php
require_once 'api/toJson_package.php';

if ( isset( $_GET[ "package_id" ] ) ) {
toJson_packageData( $_GET[ "package_id" ] );
}
?>