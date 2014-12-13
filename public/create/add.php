<?php include_once 'common/php/_head.php'; ?>
<?php include_once 'common/php/_header.php'; ?>
<script>
	window.addEventListener("load", function(){
		var btn = document.querySelector("#addFileInputButton");
		var frm = document.querySelector("#addPackageForm");
		var idx = 1;

		btn.addEventListener("click", function(){
			addInputFile(1)
		})

		function addInputFile(num){
			if(num === NaN){
				num = 1
			}
			for(var i = 0; i < num; i++){
				var fileInputWrap = document.createElement("div")
				fileInputWrap.innerHTML = '<p><label>表[' + idx +']<input name="front" type="file"></label></p><p><label>裏[' + idx + ']<input name="back" type="file"></label></p>'
				idx++;
				frm.appendChild(fileInputWrap);	
			}
		}

		addInputFile(5)
	})
</script>

<div id="main" class="container">
	<form class="form-horizontal" role="form" action="add.php" method="get">
		<div class="col-md-offset-1 col-md-9">				<!-- パッケージ左全体 -->	
			<div class="form-group">		<!-- パッケージ名 -->
				<label for="package_name" class="col-md-3 control-label">パッケージ名</label>
				<div class="col-md-9">
					<input type="text" class="form-control" id="package_name" placeholder="パッケージ名を入力してください">
				</div>
			</div>	
			<div class="form-group">		<!-- パッケージ詳細 -->
				<label for="package_info" class="col-md-3 control-label">パッケージ詳細</label>
				<div class="col-md-9">
					<textarea name="package_info" rows="3" cols="65" placeholder="パッケージの詳細を入力してください"></textarea>
				</div>
			</div>
			<div class="form-group">		<!-- タグ -->
				<label for="package_tag" class="col-md-3 control-label">検索タグ名</label>
				<div class="col-md-9">
					<input type="text" class="col-md-2 form-control" id="package_tag">
				</div>
			</div>
			<div class="form-group">		<!-- パッケージイメージ -->
				<label for="package_img" class="col-md-3 control-label">パッケージイメージ</label>
				<div class="col-md-9">
					<input type="file" class="form-control"　accept="image/*" name="" value="">
				</div>
			</div>
			<div class="form-group">		<!-- 場の背景 -->
				<label for="package_fieldbg" class="col-md-3 control-label">場の背景</label>
				<div class="col-md-9">
					<input type="file" class="form-control" accept="image/*" name="" value="">
				</div>
			</div>
			<div class="form-group">		<!-- 手札の背景 -->
				<label for="package_handbg" class="col-md-3 control-label">手札の背景</label>
				<div class="col-md-9">
					<input type="file" class="form-control"　accept="image/*" name="" value="">
				</div>
			</div>
			<div class="form-group">		<!-- ファイル投稿部 -->
				<input id="addFileInputButton" class="col-md-offset-10 btn btn-default"type="button" value="カード追加">	
				<div id="addPackageForm" class="col-md-offset-2 col-md-8"></div>
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