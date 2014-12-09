<?php include_once 'common/php/_head.php'; ?>
<?php include_once 'common/php/_header.php'; ?>
<div id="main" class="container">
	<div class="row">
		<div class="col-sm-3 col-sm-offset-9 content_header">
			<a class="add_btn" href="add.php">パッケージの追加</a>
		</div>
	</div>
	<div class="package col-sm-offset-1 col-sm-10 col-sm-offset-1 row" >	<!-- パッケージ全体 -->
		<div class="col-sm-3 package_icon">			<!-- Package画像 -->
			<a><img src="common/image/numakuro.png" alt="#"></a>
		</div>
		<div class="col-sm-9 row"> 					<!-- Package右側 -->
			<div class="row">
				<div class="col-md-offset-1 col-sm-3 package_name">
					<a>パッケージ名</a>
				</div>
				<div class="col-md-offset-1 col-sm-3 package_info"><a>2014年11月20日</a></div>
				<div class="col-md-offset-1 col-sm-3">
					<a class="edit_btn">パッケージ編集</a>
				</div>
			</div>
			<div class="tags col-sm-8">
				<ul >
					<li>Tag1</li>
					<li>Tag2</li>
					<li>Tag3</li>
				</ul>
			</div>
			<div class="links">
				<img src="common/image/Twitter_icon.png">
				<img src="common/image/QR_icon.png">
			</div>
			<p class="package_detail text-info">ここにパッケージの説明が表示されます。
		</p>
		</div>
	</div>
</div>
<?php include_once 'common/php/_footer.php'; ?>
<?php include_once 'common/php/_foot.php'; ?>