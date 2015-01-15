<?php include_once 'common/php/_head.php'; ?>
<?php

require_once '../common/lib/api/functions.php';
require_once '../common/lib/api/tukue_img_functions.php';
require_once '../common/lib/api/tukue_creator_functions.php';
require_once '../common/lib/api/tukue_object_functions.php';
require_once '../common/lib/api/tukue_package_functions.php';

$title = "LIST";

if ( isset( $_GET[ "keyword" ] ) ) {
	$keyword = $_GET[ 'keyword' ];
} else {
	$keyword = "";
}

$results = package_search( $keyword );

?>

<section class="container">

	<h1>「<?php echo $keyword;	?>」の検索結果</h1>

	<form class="well form-search" action="./list.php" method="GET">
		<input type="text" class="input-medium search-query" name="keyword">
		<button type="submit" class="btn">
			<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
		</button>
	</form>

	<ol class="breadcrumb">
		<li><a href="./index.php">トップ</a></li>
		<li class="active">「<?php echo $keyword;	?>」の検索結果</li>
	</ol>

	<!-- 	<p class="text-left">
		<a href="#" onClick="history.back(); return false;">
			<button type="button" class="btn btn-default">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>  Back
			</button>
		</a>
	</p> -->
<?php

foreach ( $results as $key => $package ) :

	$package_id = $package[ 'package_id' ];
	$package_name = $package[ 'package_name' ];
	$package_description = $package[ 'package_description' ];
	$package_author = $package[ 'creator_id' ];
	$package_time = $package[ 'package_time' ];
	$package_tag = $package[ 'package_tag' ];
	$package_image = getImaga_path( $package[ 'package_img' ] );
	$package_background_hand = getImaga_path( $package[ 'package_handbg' ] );
	$package_background_field = getImaga_path( $package[ 'package_fieldbg' ] );
	$package_detail_link = "detail.php" . "?id=" . $package_id;

	$package_tag = explode( ",", $package_tag );

	$package_cards = getcards( $package_id );

	if ( $keyword != "" ) {
		$package_detail_link .= "&keyword=" . $keyword;
	}

	$package_author = creator_toName( $package_author );
	$package_image = "../" . $package_image;

	if ( isset( $package_background_field ) ) {
		$package_background_field = "../" . $package_background_field;
	}
	if ( isset( $package_background_hand ) ) {
		$package_background_hand = "../" . $package_background_hand;
	}

	?>

	<div class="panel panel-default">
		<div class="panel-content">
			<div class="row">
				<div class="col-sm-3">
					<figure>
						<!-- <img src="<?php //echo $package_image["img_path"]; ?>" alt=""> -->
						<a href="<?php echo $package_detail_link; ?>"><img
							style="border: 3px solid;"
							src="common/image/<?php echo $package_image; ?>" height="200"
							width="200" alt=""></a>
					</figure>
				</div>

				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-6">
							<div>
								<ul class="list-inline">
									<!--５回実行したらbreakする-->
									<?php $count = 0; ?>
									<?php foreach ($package_cards as $key => $cards) :?>
										<?php if ($count>=5): ?>
											<?php break; ?>
										<?php else:?>
											<li><img src="common/image/<?php echo $cards['front']; ?>"
										height="25" width="25" alt=""></li>
									<li><img src="common/image/<?php echo $cards['back']; ?>"
										height="25" width="25" alt=""></li>
											<?php $count++; ?>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							</div>

						</div>

						<div class="col-sm-6">
							<ul class="list-inline">
								<li><img
									src="common/image/<?php echo $package_background_hand; ?>"
									height="150" width="150" alt=""></li>
								<li><img
									src="common/image/<?php echo $package_background_field; ?>"
									height="150" width="150" alt=""></li>
							</ul>
						</div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12">
									<p style="padding: 10px;"><?php echo $package_description; ?></p>
								</div>
							</div>

						</div>
					</div>
				</div>



			</div>
			<!--row end-->
		</div>
		<div class="panel-footer" style="background-color: #F0F0F0">

			<div class="row">
				<div class="col-sm-2 text-danger"><?php echo $package_name; ?></div>
				<div class="col-sm-5">
						<?php if(empty($package_tag) ) :?>
							タグ未設定
						<?php else:?>
							<!--５個まで表示 ５回実行したらbreakする-->
							<?php $count = 0; ?>
							<?php foreach ($package_tag as $key => $tag) :?>
								<?php if ($count>=5): ?>
									<?php break; ?>
								<?php else:?>
									<span class="label label-success"><?php echo $tag; ?></span>
									<?php $count++; ?>
								<?php endif; ?>
							<?php endforeach; ?>

							<?php if(count($package_tag) >= 6) :?>
								<!--省略を示す-->
								....
							<?php endif; ?>
						<?php endif; ?>
					</div>
				<div class="col-sm-2">
						投稿日： <?php echo $package_time; ?>
					</div>
				<div class="col-sm-3">
						投稿者： <?php echo $package_author; ?>
						<!-- 切り替えボタンの設定 -->
					<a data-toggle="modal" href="#myModal"
						class="btn btn-primary pull-right">QRコード</a>

					<!-- モーダルの設定 -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
						aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">
										<span aria-hidden="true">&times;</span><span class="sr-only">閉じる</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">QRコード</h4>
								</div>
								<div class="modal-body">
									<p>
										<img
											src="https://chart.googleapis.com/chart?cht=qr&chs=157x157&chco=DC143C&chl=http://localhost:8000/play.php?pid=<?php echo $package_id; ?>"
											alt="">
									</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default"
										data-dismiss="modal">閉じる</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
				</div>
			</div>
			<!--row end-->

		</div>
	</div>

	<p class="text-right">
		<a href="#">
			<button type="button" class="btn btn-default">
				<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
				<!--  Back to top -->
			</button>
		</a>
	</p>

<?php endforeach; ?>
</section>

<?php
include_once 'common/php/_foot.php';
?>