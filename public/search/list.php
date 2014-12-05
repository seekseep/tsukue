<?php 
	$title ="LIST";
	include_once 'common/php/_head.php';
 ?>

<section class="container">


<h1>list</h1>

<form class="well form-search" action="./list.php" method="GET">
	<input type="text" class="input-medium search-query" name="keyword">
	<button type="submit" class="btn"> 検 索 </button>
</form>

<?php 
$results = array(
		array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
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
						)										
				)
			),
		array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
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
						)										
				)
			),
		array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
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
						)										
				)
			),
		array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
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
						)										
				)
			),
		array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
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
						)										
				)
			),
		array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
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
						)										
				)
			),
		array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
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
						)										
				)
			),
		array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
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
						)										
				)
			),
		array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
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
						)										
				)
			),
		array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
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
						)										
				)
			),
		array(
			"id" => "p_00001",
			"name" => "パッケージ1",
			"author" => "大谷",
			"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
			"image" => "numakuro.png",
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
						)										
				)
			),
	);

 ?>
<?php foreach ($results as $key => $package) : ?>
	<?php 
		$package_id = $package['id'];
		$package_name = $package['name'];
		$package_author = $package['author'];
		$package_description = $package['description'];
		$package_image = $package['image'];
		$package_cards = $package['cards'];
	?>
	

	<div class="panel panel-default">
		<div class="panel-content">
			<div class="row">
				<div class="col-sm-3" >
					<figure>
						<!-- <img src="<?php echo $package_image; ?>" alt=""> -->
						<img src="common/image/<?php echo $package_image; ?>" height="200" width="200" alt="">
					</figure>
				</div>
			    <div class="col-sm-6" >
			    	<div>
			    		<ul class="list-inline">
			    			<!--５回実行したらbreakする-->
			    			<?php $count = 0; ?>
				    	   	<?php foreach ($package_cards as $key => $cards) :?>
								<?php if ($count>=5): ?>
									<?php break; ?>
								<?php else:?>
								<li><img src="common/image/<?php echo $cards['front']; ?>" height="50" width="50" alt=""></li>
								<li><img src="common/image/<?php echo $cards['back']; ?>"  height="50" width="50" alt=""></li>
								<?php $count++; ?>
								<?php endif ?>
							<?php endforeach; ?>	
				    	</ul>
				    </div>
				    
				    <div>
				    	<p><?php echo $package_description; ?></p></p>
				    </div>	
				    
				    <!-- <ul class="list-inline">
				    	<li>
					    	<?php foreach ($package_cards as $key => $cards) :?>
							<li><img src="<?php echo $cards['front']; ?>" alt=""></li>
							<li><img src="<?php echo $cards['back']; ?>" alt=""></li>
							<?php endforeach; ?>
				    	</li>
				    	<li>
				    		<p><?php echo $package_description; ?></p></p>
				    	</li>
				    </ul> -->

			    </div>
			    <div class="col-sm-3" ></div> 	
			</div>			
		</div>
		<div class="panel-footer" style="background-color: #F0F0F0" >
			<div class="row">
				
				<div class="col-sm-2 text-danger"><?php echo $package_name; ?></div>
				<div class="col-sm-2"><?php echo $package_author; ?></div>
				<div class="col-sm-6"></div>
				<div class="col-sm-1">
					<p class=""><a href="view.php?id=<?php echo $package_id; ?>"><?php echo $package_id; ?></a></p>
				</div>
				<div class="col-sm-1">
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
					        <p><img src="https://chart.googleapis.com/chart?cht=qr&chs=157x157&chco=DC143C&chl=http://localhost:8000/play.php?pid=<?php echo "$package_id"; ?>" alt=""></p>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					      </div>
					    </div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</div>
			</div>
		</div>	
	</div>
			
	

<?php endforeach; ?>

</section>