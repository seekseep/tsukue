<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>

<body>

<?php
/*
 *
 * functions
 *
 */

mb_language("Japanese");

function dir_get_path($dir){ // Package名を返す

	$fileArrayAsc = scandir($dir);
	return $fileArrayAsc;
}


function file_write($dir){ //json形式でパッケージについてファイルを作成・追記する
	$pkg_id = 0;
	$pkg_text = $dir . '/Package.json';

		$pkg_arr = array(
				'Package_ID' => $pkg_id,
				'Package_Name' => $_SESSION['pkg_name'],
				'Upload_Time' => get_time(),
				'Files' => dir_get_path($dir)
		);

		file_put_contents($pkg_text, json_encode($pkg_arr));
	}


function mkdir_time(){

	return date('Y-m-d-H-i-s');
}

function make_dir($dir){

	/*
	 * ディレクトリ作成関数
	 * パッケージを投稿したときにディレクトリを作成します。
	 */
	if(is_file($dir) == false){
		if(file_exists($dir) == false){
			mkdir($dir, 0755);//ディレクトリがなければ作る
			mkdir($dir . '/img', 0755);
		}else{
			echo 'そのパッケージ名はすでにあります。<br />';
		}
		return $dir;
	}
}

function file_dele() {

}

function confirm_img_front($gazo_front, $dir){ // front(表)の画像アップロードの処理

	/*
	 * 表の画像アップロード処理
	 * 画像n表で指定された画像をここでディレクトリ/パッケージ名/img/front_n.拡張子に処理してます。
	 */
	$dir = $dir . '/img/';
	Encoding_conversion($dir);

	$gazo_front_path = $gazo_front['tmp_name'];
	foreach ($gazo_front_path as $key => $path){

		if(strlen($path) > 0){
			$images_front = file_get_contents($path);
			switch ($gazo_front['type'][$key]){
				case 'image/jpeg' :
					file_put_contents($dir . 'front_' . $key . '.jpg', $images_front);
					break;
				case 'image/png' :
					file_put_contents($dir . 'front_' . $key . '.png', $images_front);
					break;
				case 'image/gif' :
					file_put_contents($dir . 'front_' . $key . '.gif', $images_front);
					break;
			}
		}
	}
}

function confirm_img_back($gazo_back, $dir){

	/*
	 * 裏の画像アップロード処理
	 * 画像n裏で指定された画像をここでディレクトリ/パッケージ名/img/back_n.拡張子に処理してます。
	 */
	$dir = $dir . '/img/';
	Encoding_conversion($dir);

	$gazo_back_path = $gazo_back['tmp_name'];
	foreach ($gazo_back_path as $key => $path){
		if(strlen($path) > 0){
			$images_back = file_get_contents($path);

			switch ($gazo_back['type'][$key]){
				case 'image/jpeg' :
					file_put_contents($dir . 'back_' . $key . '.jpg', $images_back);
					break;
				case 'image/png' :
					file_put_contents($dir . 'back_' . $key . '.png', $images_back);
					break;
				case 'image/gif' :
					file_put_contents($dir . 'back_' . $key . '.gif', $images_back);
					break;
			}
		}
	}
}

function get_time(){

	/*
	 * 投稿時間をパッケージ名にするための関数
	 * この関数はjsonファイルに投稿時間を表記するために使っています。
	 */
	return date('Y-m-d-h:i:s');

}

/*
 * img_dispとview_img_dispの違い
 * img_dispをconfirmとviewで使うとviewで削除を出そうとするとconfirmにも出てしまうので分けました。
*/
function img_disp($dir){

	/*
	 * パッケージ投稿時にconfirm.phpで画像を表示する
	 */
	$dir .= '/img/';
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			echo '<br />';
			while (($file = readdir($dh)) !== false) {
				$info = new SplFileInfo($file);
				if($file != "." && $file != "..") {
						echo '<p>';
						echo '<img src="' . $dir . $file . '" width="20%">' . $file . '<br />';
						echo '</p>';

				}
			}
			closedir($dh);
		}
	}
}

function view_img_disp($dir){

	/*
	 * view.phpで画像と削除用チェックボックスとボタンを表示
	 * ボタン押すとimg_delete_confirm.phpへ遷移し、削除する画像の一覧を出す
	 */
	$dir .= '/img/';
	if (is_dir($dir)) { //ディレクトリであればtrueを返す
		if ($dh = opendir($dir)) {
			echo '<br />';
			while (($file = readdir($dh)) !== false) {
				if($file != "." && $file != "..") { //$fileは . と .. を返すので、それを表示させないようにif文を書きました。
					echo '<p>';
			?>
			<table border="0">
				<tr>
					<th style="background-color:yellowgreen; width: 100px;">
						<?php echo $file; echo '<br  />'; ?>
						<form action="img_delete.php" method="post"><!-- ボタン→チェックボックスによる選択式 -->
							<label><input type="checkbox" name="delete_f[]" value="<?php echo $dir.$file; ?>">削除する</label>
					</th>
					<td>
						<img src="<?php echo $dir . $file?>" width="20%">
					</td>
				</tr>
			</table>

			<?php
			echo '</p>';
				}
			}
			?>
			<p><input type="submit" value="確認"></p>
			</form>
			<?php
			closedir($dh);
		}
	}
}


// function unzip($zip, $dir){ // zip解凍
	/*
	 * zipで投稿されたパッケージを任意のディレクトリに解凍します。
	 * $dirのディレクトリに解凍されます。
	 */

// 	try{
// 		$test = $zip['tmp_name'];
// 		$test = Encoding_conversion($test);
// 		echo mb_detect_encoding($test);
// 		$phar = new PharData($test);
// 		$phar->extractTo($dir, null, false); // すべてのファイルを展開し、上書きはしない
// // 		$dir_path = dir_get_path($dir);
// // 		$dir = $dir . $dir_path[2] . '/Package.txt';
// // 		file_put_contents($dir, json_encode(get_time()));
// 		echo '成功<br />';
// 	}catch (Exception $e){
// 		echo 'すでに同じパッケージ名がすでにあるか、何らかの原因で失敗しました。';
// 	}
// }

function Encoding_conversion ($enc_con){

	/*
	 * WindowsではCP932を他では、UTF-8を使っているので、それぞれ用途に合わせて文字エンコードを変換します。
	 * windowsでファイルやディレクトリを作成するときはUTF-8→CP932に
	 * webページ等で表示するときはCP932→UTF-8に変換してください。
	 */


	if(mb_detect_encoding($enc_con, "UTF-8, CP932, ASCII") == "UTF-8" && mb_detect_encoding($enc_con, "ASCII, CP932, UTF-8") == "ASCII"){
		$enc_con = mb_convert_encoding($enc_con, "CP932", "UTF-8");
		return $enc_con;
	}else if(mb_detect_encoding($enc_con, "ASCII, UTF-8, CP932") == "CP932"){
		$enc_con = mb_convert_encoding($enc_con, "UTF-8", "CP932");
		return $enc_con;
	}else if(mb_detect_encoding($enc_con, "ASCII, UTF-8, CP932") == "ASCII"){
		$enc_con = mb_convert_encoding($enc_con, "UTF-8", "ASCII");
		return $enc_con;
	}
}

function delete_dir($dele_dir){
	/*
	 * confirmで表示された後、Okボタンを押されたらtmpから移動するがディレクトリ移動が見つからなかったので、
	 * json、画像ファイルをすべて移動した後、削除するようにしました。
	 * tmpから移動された先では同じパッケージ名のディレクトリが作られるようにしています。
	 */

	rmdir($dele_dir);
}

?>

</body>
</html>
