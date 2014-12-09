<?php include_once 'common/php/_head.php'; ?>
<?php include_once 'common/php/_header.php'; ?>

<div id="main" class="container">
	<form class="form-horizontal" role="form">
		<div class="col-md-9">
			<div class="form-group">
				<label for="package_name" class="col-md-3 control-label">パッケージ名</label>
				<div class="col-md-6">
					<input type="text" class="form-control" id="package_name" placeholder="パッケージ名を入力してください">
				</div>
			</div>

			<div class="form-group">
				<label for="package_info" class="col-md-3 control-label">パッケージ詳細</label>
				<div class="col-md-6">
					<textarea name="package_info" rows="3" cols="60" placeholder="パッケージの詳細を入力してください"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="package_name" class="col-md-3 control-label">検索タグ名</label>
				<div class="col-md-6">
					<input type="text" class="form-control" id="package_name" placeholder="タグ名を入力してください">
				</div>
			</div>

			<div class="row">
				<label for="package_name" class="col-md-3 control-label">場の背景</label>
				<div class="col-md-6">
					<input type="file" class="form-control" name="" value="">
				</div>
			</div>

			<div class="row">	
				<label for="package_name" class="col-md-3 control-label">手札の背景</label>
				<div class="col-md-6">
					<input type="file" class="form-control" name="" value="">
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<img src="common/image/numakuro.png" class="img-responsive" alt="Responsive image"height="440"width="452">
			</div>
		</div>
		<div class="col-md-offset-11 col-md-1">	
			<div class="form-group">
				<button type="button" class="btn btn-primary btn-lg ">保存</button>
			</div>
		</div>
	</form>
</div>
<?php include_once 'common/php/_footer.php'; ?>
<?php include_once 'common/php/_foot.php'; ?>