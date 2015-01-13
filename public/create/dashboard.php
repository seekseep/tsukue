<?php require_once '../common/lib/api/tukue_package_functions.php';?>
<?php require_once '../common/lib/api/tukue_img_functions.php';?>
<?php include_once 'common/php/_head.php'; ?>
<?php include_once 'common/php/_header.php'; ?>
<div id="main" class="container" style="min-height: 600px">
	<div class="row">
		<div class="col-md-3 col-md-offset-9 content_header">
			<a class="btn btn-info btn-lg" href="add.php">パッケージの追加</a>
		</div>
	</div>

<?php
ini_set ( 'display_errors', 1 );
if ( isset( $_SESSION[ 'creator_name' ] ) ) {
	$creator_name = $_SESSION[ 'creator_name' ];
}

$results = getPackage_all( $creator_name );

foreach ( $results as $key => $val ) {

$val[ "package_tag" ] = explode( ",", $val[ "package_tag" ] );

$PackageImage = getPackageImage( $val[ "package_img" ] );
$PackageImage = "../" . $PackageImage[ "img_path" ];
	?>
<div class="package col-md-offset-1 col-md-10 row">
		<!-- パッケージ全体 -->
		<div class="col-md-3 package_icon">
			<!-- Package画像 -->
			<img src=" <?php echo $PackageImage; ?> "
				class="img-thumbnail" alt="#">
		</div>
		<div class="col-md-9 row">
			<!-- Package右側 -->
			<div class="row">
				<div class="col-md-4 package_name text-danger">
			<?php echo $val["package_name"]; ?>
			</div>
				<div class="col-md-4 package_time">
				<?php echo $val["package_time"]; ?>	<!-- パッケージ日時 -->
			</div>
				<div class="col-md-4">
					<a href="edit.php?id=<?php echo $val["package_id"]; ?>" class="btn btn-primary">パッケージ編集</a>
					<button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
				</div><!-- 編集 -->
			</div>
			<div class="tags col-md-8">	<!-- タグ -->
			<?php foreach( $val[ "package_tag" ] as $key => $tag ) { ?>
			<span class="label label-success"><?php echo $tag; ?></span>
			<?php } ?>
			</span>
				
			</div>
			<div class="links col-md-offset-10">
				<!-- <a href="http://twitter.com"><img src="common/image/Twitter_icon.png"></a> -->

				<a data-toggle="modal" href="#myModal"
					class="btn btn-default pull-right">QRコード</a>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<img
								src="http://chart.apis.google.com/chart?cht=qr&chs=250x250&chl=http://kinako.asia/?id=<?php echo $val["package_id"]; ?>"
								alt="">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div><!-- Modal -->
			<div class="col-md-9 row"
				<p class="package_description text-info">
				<?php echo $val["package_description"]; ?>
			</p>
			</div>
		</div>
	</div>
	<?php
}
?>
</div>

<?php include_once 'common/php/_footer.php'; ?>
<?php include_once 'common/php/_foot.php'; ?>
