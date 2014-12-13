<?php include_once 'common/php/_head.php'; ?>
<?php include_once 'common/php/_header.php'; ?>
<div id="main" class="container" style="min-height:600px">
	<div class="row">
		<div class="col-md-3 col-md-offset-9 content_header">
			<a class="btn btn-info btn-lg" href="add.php">パッケージの追加</a>
		</div>
	</div>
	<div class="package col-md-offset-1 col-md-10 row">	<!-- パッケージ全体 -->
		<div class="col-md-3 package_icon">			<!-- Package画像 -->
			<img src="common/image/numakuro.png" class="img-thumbnail" alt="#">
		</div>
		<div class="col-md-9 row"> 					<!-- Package右側 -->
			<div class="row">
				<div class="col-md-offset-1 col-md-3 package_name text-danger">
					パッケージ名
				</div> 
				<div class="col-md-offset-1 col-md-3 package_info">
					2014年11月20日</div>
					<div class="col-md-offset-1 col-md-3">
						<a class="btn btn-primary">パッケージ編集</a>
					</div>
				</div>
				<div class="tags col-md-8">
					<span class="label label-success">
						tag
					</span>
				</div>
				<div class="links">
					<a href="http://twitter.com"><img src="common/image/Twitter_icon.png"></a>

					<a data-toggle="modal" data-target="#myModal"><img src="common/image/QR_icon.png"></a>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">Modal title</h4>
							</div>
							<div class="modal-body">
								<img src="http://chart.apis.google.com/chart?cht=qr&chs=250x250&chl=http://kinako.asia/" alt=""> 
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal -->
				<p class="package_detail text-info">ここにパッケージの説明が表示されます。
				</p>
			</div>
		</div>
	</div>
	<?php include_once 'common/php/_footer.php'; ?>
	<?php include_once 'common/php/_foot.php'; ?>