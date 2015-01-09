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
				fileInputWrap.innerHTML = '<p class="col-md-6 "><label>表[' + idx +']<input name="front[]" type="file">	</label></p><p class="col-md-6 "><label>裏[' + idx + ']<input name="back[]" type="file"></label></p>'
				idx++;
				frm.appendChild(fileInputWrap);
			}
		}
		addInputFile(2)
	})
</script>
<?php
$results = "";

$results = array(
	array(
		"id" => "p_00001",
		"name" => "パッケージ1",
		"author" => "大谷",
		"time" => "2025/12/31",
		"tag" => array(
			"トランプ","シンプル","ゲーム","オリジナル","オリジナル画像","ヌマクロー","ポケモン",),
		"description" => "このパッケージは大谷の熱いゲームへの思いがたくさん込められています。スマートフォンの枠に収まるようにがんばりました。",
		"image" => "numakuro.png",
		"hand" => "numakuro.png",
		"field" => "numakuro.png",
		)
	);

?>

<div id="main" class="container">
	<form class="form-horizontal" role="form" action="../common/lib/confirm.php" method="post" enctype="multipart/form-data">
		<div class="col-md-offset-1 col-md-9 col-md-offset-2">
			<div class="form-group">		<!-- パッケージ名 -->
				<label for="package_name" class="col-md-3 control-label">パッケージ名</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="package_name" placeholder="パッケージ名を入力してください">
				</div>
			</div>
			<div class="form-group">		<!-- パッケージ詳細 -->
				<label for="package_description" class="col-md-3 control-label">パッケージ詳細</label>
				<div class="col-md-9">
					<textarea name="package_description" rows="3" pxlaceholder="パッケージの詳細を入力してください" style="width:100%" rows=4></textarea>
				</div>
			</div>
			<div class="form-group">		<!-- タグ -->
				<label for="package_tag" class="col-md-3 control-label">検索タグ名</label>
				<div class="col-md-9">
					<input type="text" name="package_tag" value="ここにタグを入力してください" data-role="tagsinput" >
				</div>
			</div>
			<div class="form-group">		<!-- パッケージイメージ -->
				<label for="package_image" class="col-md-3 control-label">パッケージイメージ</label>
				<div class="col-md-9">
					<input type="file" class="form-control"　accept="image/*" name="package_image" value="">
				</div>
			</div>
			<div class="form-group">		<!-- 場の背景 -->
				<label for="package_fieldbg" class="col-md-3 control-label">場の背景</label>
				<div class="col-md-9">
					<input type="file" class="form-control" accept="image/*" name="package_fieldbg" value="">
				</div>
			</div>
			<div class="form-group">		<!-- 手札の背景 -->
				<label for="package_handbg" class="col-md-3 control-label">手札の背景</label>
				<div class="col-md-9">
					<input type="file" class="form-control"　accept="image/*" name="package_handbg" value="">
				</div>
			</div>
		</div>
		<div class="form-group">		<!-- ファイル投稿部 -->
			<input id="addFileInputButton" class="col-md-offset-9 btn btn-default"type="button" value="カード追加">
			<div id="addPackageForm" class=" col-md-offset-2 col-md-9 "></div>
		<div class="col-md-offset-11 col-md-1">
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-lg" onclick="">保存</button>
			</div>
		</div>
	</form>
</div>
<?php include_once 'common/php/_footer.php'; ?>
<?php include_once 'common/php/_foot.php'; ?>