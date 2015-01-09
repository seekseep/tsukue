<?php setcookie( "tsukue", "", 0, '/', "kinako.asia" ); ?>
<?php include_once 'common/php/_head.php'; ?>
<?php include_once 'common/php/_header.php'; ?>


<div class="container">

	<div id="title_logo" class="row">
		<!-- たいとる -->
		<div class="col-sm-8 col-sm-offset-2">
			<h1 class="text-center">Virtual Table Platform</h1>
		</div>
	</div>

	<div id="login_btn" class="row">
		<!-- ログイン画面 -->
		<div class="col-sm-8 col-sm-offset-2">
			<h1 class="text-center">
				<button type="button" class="btn btn-primary btn-lg "
					onclick="location.href='login.php'">パッケージを投稿する</button>
			</h1>
		</div>
	</div>

	<div id="top_header_3" class="row">
		<!-- プレイ画面への誘導 -->
		<div class="col-sm-8 col-sm-offset-2">
			<h1 class="text-center">
				<button type="button" class="btn btn-primary btn-lg ">play画面に移動</button>
			</h1>
		</div>
	</div>
</div>
<?php include_once 'common/php/_footer.php'; ?>
<?php include_once 'common/php/_foot.php'; ?>