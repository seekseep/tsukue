<?php 
	$title ="VIEW";
	include_once 'common/php/_head.php';
 ?>
<?php if (isset($_GET['id'])) : ?>
	<?php
		$package = array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "x",
			"cards" => array(
					array(
							"index" => "0",
							"front" => "front_image_src",
							"back" => "back_image_src",
						),
					array(
							"index" => "0",
							"front" => "front_image_src",
							"back" => "back_image_src",
						),
					array(
							"index" => "0",
							"front" => "front_image_src",
							"back" => "back_image_src",
						),
					array(
							"index" => "0",
							"front" => "front_image_src",
							"back" => "back_image_src",
						),
					array(
							"index" => "0",                            
							"front" => "front_image_src",
							"back" => "back_image_src",
						),
					array(
							"index" => "0",
							"front" => "front_image_src",
							"back" => "back_image_src",
						),
					array(
							"index" => "0",
							"front" => "front_image_src",
							"back" => "back_image_src",
						),
					array(
							"index" => "0",
							"front" => "front_image_src",
							"back" => "back_image_src",
						)										
				)
			);
		?>	
	
	<?php 
		$package_id = $package['id'];
		$package_name = $package['name'];
		$package_author = $package['author'];
		$package_description = $package['description'];
		$package_image = $package['image'];
		$package_cards = $package['cards'];

	?>
	<section class="container">
		<div class="row">
			<div class="col-sm-1" >
				<p><a href="view.php?id=<?php echo $package_id; ?>"><?php echo $package_id; ?></a></p>
			</div>
			<div class="col-sm-2"><?php echo $package_name; ?></div>
			<div class="col-sm-2"><?php echo $package_author; ?></div>
			<div class="col-sm-7"></div>
		</div>

		<div class="row">
			<div class="col-sm-3" >
				<figure>
					<!-- <img src="<?php echo $package_image; ?>" alt=""> -->
					<img src="common/image/numakuro.png" height="200" width="200" alt="">
				</figure>
			</div>
		    <div class="col-sm-6" >
		    	<p><?php echo $package_description; ?></p></p>
		    </div>
		    <div class="col-sm-3" ></div> 	
		</div>

		<div class="row">
			<ul class="list-inline">
			<?php foreach ($package_cards as $key => $cards) :?>
				<li><img src="<?php echo $cards['front']; ?>" alt=""></li>
				<li><img src="<?php echo $cards['back']; ?>" alt=""></li>
			<?php endforeach; ?>
			</ul>	
		</div>
	</section>
	<hr>


		


		


	 
<?php else: ?>
	<html>
		<head>
			<meta http-equiv="refresh" content="0;URL=./index.php">
		</head>
	</html>
<?php endif; ?>