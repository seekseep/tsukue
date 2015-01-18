<?php
$title = "DETAIL";
include_once 'common/php/_head.php';

require_once '../common/lib/api/functions.php';
require_once '../common/lib/api/tukue_img_functions.php';
require_once '../common/lib/api/tukue_creator_functions.php';
require_once '../common/lib/api/tukue_object_functions.php';
require_once '../common/lib/api/tukue_package_functions.php';


if ( isset( $_GET[ "keyword" ] ) ) {
	$keyword = $_GET[ 'keyword' ];
} else {
	$keyword = "";
}

?>

<section class="container">
	<?php
	if ( isset( $_GET[ 'id' ] ) ) :
		$package_id = $_GET[ 'id' ];
		?>

	<!--受け取ったデータから値の取出し-->
	<?php
	$results = detail ( $package_id );

		foreach ( $results as $key => $package ) {


			$package_id = $package[ 'package_id' ];
			$package_name = $package[ 'package_name' ];
			$package_description = $package[ 'package_description' ];
			$package_author = $package[ 'creator_id' ];
			$package_time = $package[ 'package_time' ];
			$package_tag = $package[ 'package_tag' ];
			$package_image = getImaga_path( $package[ 'package_img' ] );
			$package_background_hand = getImaga_path( $package[ 'package_handbg' ] );
			$package_background_field = getImaga_path( $package[ 'package_fieldbg' ] );


		}
		$package_tag = explode( ",", $package_tag );
		$package_cards = getcards( $package_id );

		$package_author = creator_toName( $package_author );
		$package_image = "../" . $package_image;

		if ( isset( $package_background_field ) ) {
			$package_background_field = "../" . $package_background_field;
		}
		if ( isset( $package_background_hand ) ) {
			$package_background_hand = "../" . $package_background_hand;
		}
		?>



	<h1><?php echo "$package_name"; ?></h1>

	<form class="well form-search" action="./list.php" method="GET">
		<input type="text" class="input-medium search-query" name="keyword">
		<button type="submit" class="btn">
			<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
		</button>
	</form>

	<ol class="breadcrumb">
		<li><a href="./index.php">トップ</a></li>
	<?php

		if ( $keyword != "" ) :
			?>
	<?php $href = "./list.php" . "?" . "keyword=" . $keyword;  ?>
	<li><a href="<?php echo $href; ?>">「<?php echo $keyword; ?>」の検索結果</a></li>
	<?php endif; ?>
	<li class="active"><?php echo "$package_name"; ?></li>
	</ol>



	<!-- 	<p class="text-left">
	<a href="#" onClick="history.back(); return false;">
		<button type="button" class="btn btn-default">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		</button>
	</a>
	</p> -->



	<div class="panel panel-default">

		<div class="panel-heading" style="background-color: #F0F0F0">
			<div class="row">

				<div class="col-sm-2 text-danger"><?php echo $package_name; ?></div>
				<div class="col-sm-5">
					<?php if(empty($package_tag) ) :?>
						タグ未設定
					<?php else:?>

						<?php foreach ( $package_tag as $key => $tag ) : ?>
							<span class="label label-success"><?php echo $tag; ?></span>

						<?php endforeach; ?>

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
									<!--QR生成につかうURLを指定-->
									<p>
										<img
											src="https://chart.googleapis.com/chart?cht=qr&chs=157x157&chco=DC143C&chl=http://localhost:8000/play.php?pid=<?php echo "$package_id"; ?>"
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




		<div class="panel-content">
			<div class="row">
				<div class="col-sm-3">
					<h3 class="text-center">
						<!-- <img src="<?php echo $package_image; ?>" alt=""> -->
						<img style="border: 3px solid;"
							src="common/image/<?php echo $package_image; ?>" height="200"
							width="200" alt="">
					</h3>
				</div>

				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-12">
							<h3>説明 :</h3>
							<p><?php echo $package_description; ?></p>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<h3>背景画像 - 手札 &amp; 場 :</h3>
							<ul class="list-inline">
								<li><img
									src="common/image/<?php echo $package_background_hand; ?>"
									height="400" width="400" alt=""></li>
								<li><img
									src="common/image/<?php echo $package_background_field; ?>"
									height="400" width="400" alt=""></li>
							</ul>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div>
								<h3>カード:</h3>
								<ul class="card-list list-inline">
						    	   	<?php $count=1; ?>
						    	   	<?php foreach ( $package_cards as $key => $cards ) : ?>
										<li class="text-center">
										<h4><?php echo $count; ?></h4>
										<ul class="list-inline">
											<li><span class="image"><img
													src="common/image/<?php echo $cards[ 'front' ]; ?>"
													height="100" width="100" alt=""></span><br />
												<h4>
													<span class="caption label label-primary">表</span>
												</h4></li>
											<li><span class="image"><img
													src="common/image/<?php echo $cards['back']; ?>"
													height="100" width="100" alt=""></span><br />
												<h4>
													<span class="caption label label-danger">裏</span>
												</h4></li>
										</ul>
											<?php $count++; ?>
										</li>
									<?php endforeach; ?>
						    	</ul>
							</div>

						</div>
					</div>





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


	<?php else: ?>
		<html>
<head>
<meta http-equiv="refresh" content="0;URL=./index.php">
</head>
	</html>
	<?php endif; ?>


</section>



<?php
include_once 'common/php/_foot.php';
?>
