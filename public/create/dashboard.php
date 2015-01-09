<?php include_once 'common/php/_head.php'; ?>
<?php include_once 'common/php/_header.php'; ?>
<div id="main" class="container" style="min-height: 600px">
	<div class="row">
		<div class="col-md-3 col-md-offset-9 content_header">
			<a class="btn btn-info btn-lg" href="add.php">パッケージの追加</a>
		</div>
	</div>

<?php

// $results =　array(
// "id" => "p_00001",
// "name" => "パッケージ1",
// "author" => "大谷",
// "time" => "2025/12/31",
// "tag" => array("トランプ","シンプル","ゲーム","オリジナル","オリジナル画像","ヌマクロー","ポケモン",),
// "description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
// "image" => "numakuro.png",
// "hand" => "numakuro.png",
// "field" => "numakuro.png",
// ),

// 仮のパッケージデータ
$package_id = "0001";
$package_name = "ヌマクロートランプ";
$package_description = "ここにパッケージの説明が表示されるはずです";
$package_tag = array(
		"ヌマクローがいく〜ストーリーモード〜",
		"シンプル",
		"ゲーム",
		"オリジナル",
		"オリジナル画像",
		"ヌマクロー",
		"ポケモン"
);
$package_image = "common/image/numakuro.png";
$package_time = "1234/56/78 12:34:56"?>



<div class="package col-md-offset-1 col-md-10 row">
		<!-- パッケージ全体 -->
		<div class="col-md-3 package_icon">
			<!-- Package画像 -->
			<img src=" <?php echo $package_image ?> " class="img-thumbnail"
				alt="#">
		</div>
		<div class="col-md-9 row">
			<!-- Package右側 -->
			<div class="row">
				<div class="col-md-offset-1 col-md-4 package_name text-danger">
			<?php echo $package_name; ?>
			</div>
				<div class="col-md-4 package_time">
				<?php echo $package_time?>
			</div>
				<div class="col-md-3">
					<a class="btn btn-primary">パッケージ編集</a>
				</div>
			</div>
			<div class="tags col-md-8">
			<?php
			foreach ( $package_tag as $value ) {
				echo ( '<span class="label label-success" style="float:left; margin:1px">' . $value . '</span>' );
			}
			?>
		</div>
			<div class="links col-md-offset-9">
				<a href="http://twitter.com"><img
					src="common/image/Twitter_icon.png"></a>
				<!-- <a data-toggle="modal" data-target="#myModal"><img src="common/image/QR_icon.png"></a> -->
				<a data-toggle="modal" href="#myModal"
					class="btn btn-default pull-right">QRコード</a>
			</div>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<!-- Modal -->
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<img
								src="http://chart.apis.google.com/chart?cht=qr&chs=250x250&chl=http://kinako.asia/id=<?php echo $package_id ?>"
								alt="">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<p class="package_description text-info">
			<?php echo($package_description)?>
		</p>
		</div>
	</div>
</div>
<?php include_once 'common/php/_footer.php'; ?>
<?php include_once 'common/php/_foot.php'; ?>