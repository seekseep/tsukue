<?php 
	$title ="detail";
	include_once 'common/php/_head.php';
 ?>

<section class="container">


	<?php if (isset($_GET['id'])) : ?>
	<?php
		$package = array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"time" => "2025/12/31",
			"tag" => array(
				"トランプ","シンプル","ゲーム","オリジナル","オリジナル画像","ヌマクロー","ポケモン",

				),
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
			"hand" => "numakuro.png",
			"field" => "numakuro.png",
			"cards" => array(
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						),
					array(
							"index" => "0",
							"front" => "sample_front.png",
							"back" => "sample_back.png",
						)									
				)
		);
	?>	
	
	<h1>detail</h1>

	<form class="well form-search" action="./list.php" method="GET">
	<input type="text" class="input-medium search-query" name="keyword">
	<button type="submit" class="btn"> 検 索 </button>
	</form>

	<!--受け取ったデータから値の取出し-->
	<?php 
		$package_id = $package['id'];
		$package_name = $package['name'];
		$package_description = $package['description'];
		$package_author = $package['author'];
		$package_time = $package['time'];
		$package_tag = $package['tag'];
		$package_image = $package['image'];
		$package_cards = $package['cards'];
		$package_background_hand = $package['hand'];
		$package_background_field = $package['field'];
	?>
	
	<div class="panel panel-default">
		<div class="panel-content">
			<div class="row">
				<div class="col-sm-3" >
					<figure>
						<!-- <img src="<?php echo $package_image; ?>" alt=""> -->
						<a href="detail.php?id=<?php echo $package_id; ?>"><img style="border:3px solid;" src="common/image/<?php echo $package_image; ?>" height="200" width="200" alt=""></a>
					</figure>
				</div>

				<div class="col-sm-9">
					<div class="row">
					    <div class="col-sm-12" >
					    	<div>
					    		cards :
					    		<ul class="list-inline">
						    	   	<?php foreach ($package_cards as $key => $cards) :?>

										<li><img src="common/image/<?php echo $cards['front']; ?>" height="100" width="100" alt=""></li>
										<li><img src="common/image/<?php echo $cards['back']; ?>"  height="100" width="100" alt=""></li>

									<?php endforeach; ?>	
						    	</ul>
						    </div>
						  
					    </div>
					</div>

					<div class="row">
					    <div class="col-sm-12" >
					    	background images - hand &amp; field :
					    	<ul class="list-inline">
					    		<li><img src="common/image/<?php echo $package_background_hand; ?>" height="100" width="100" alt=""></li>
					    		<li><img src="common/image/<?php echo $package_background_field; ?>" height="100" width="100" alt=""></li>
					    	</ul>
					    </div>   
					</div>

					<div class="row">
							<div class="col-sm-12" >
								description :
								<p><?php echo $package_description; ?></p>
							</div>
					</div>

				</div>

				
			  
			</div><!--row end-->
		</div>
		<div class="panel-footer" style="background-color: #F0F0F0" >
			<div class="row">
				
				<div class="col-sm-2 text-danger"><?php echo $package_name; ?></div>
				<div class="col-sm-5">
					<?php if(empty($package_tag) ) :?>
						No tags.
					<?php else:?>

						<?php foreach ($package_tag as $key => $tag) :?>

							<span class="label label-success"><?php echo $tag; ?></span>

						<?php endforeach; ?>

					<?php endif ?>
				</div>
				<div class="col-sm-2">
					posted: <?php echo $package_time; ?>
				</div>
				<div class="col-sm-2">by <?php echo $package_author; ?></div>
				<div class="col-sm-1" style="padding:3px;">
					<!-- 切り替えボタンの設定 -->
					<a data-toggle="modal" href="#myModal" class="btn btn-primary">QRコード</a>

					<!-- モーダルの設定 -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">閉じる</span></button>
					        <h4 class="modal-title" id="myModalLabel">QRコード</h4>
					      </div>
					      <div class="modal-body">
					      	<!--QR生成につかうURLを指定-->
					        <p><img src="https://chart.googleapis.com/chart?cht=qr&chs=157x157&chco=DC143C&chl=http://localhost:8000/play.php?pid=<?php echo "$package_id"; ?>" alt=""></p>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					      </div>
					    </div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</div>
			</div><!--row end-->
		</div>
	</div>
	
	<p><a href="#">
		<button type="button" class="btn btn-default">
			<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span> Back to top
		</button>
	</a></p>

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
