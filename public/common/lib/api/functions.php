<?php

function toJson( $data ) {
	/*
	 * $dataをjson形式にして返す関数
	 * 2014/12/13完成済み $data 連想配列
	 */

	header('Content-type: application/json; charset=utf-8'); //ここから先はjsonであることを示すので、jsonするときはこれを書こう！
	return json_encode( $data, JSON_UNESCAPED_UNICODE ); //jsonにエンコードする/
	exit();
}

function make_directory ( $dir ) {

	/*
	 * ディレクトリ作成関数
	 * この関数が呼び出されたとき、$dir変数をもとにディレクトリがなければディレクトリを作成します。
	 * ../や./は有効です。
	 * @param $dir ディレクトリのパス テキスト
	 * 2014/12/13完成済み
	 */

	if( !is_file( $dir ) ) { // $dirがファイルかどうか falseなら以下を処理
		if( !file_exists( $dir ) ) { // $dirが存在するかどうか存在しないなら以下を処理
			mkdir( $dir, 0755 ); // $dirが存在しなかったと判断し、ディレクトリを作る
			return $dir;
		} else {
			'それはファイルであったかすでに作成済みです。'; // $dirがファイルであったか、存在しているのでエラー文を吐く
		}
	}
}

function getFile_list( $dir ) {

	/*
	 * $dirのディレクトリ内の一覧を返す
	 * ./や../は無効
	 * @param $dir ディレクトリのパス テキスト
	 * 2024/12/13完成済み
	 */
	$lists = scandir( $dir ); //ディレクトリの中身を$listsに配列で格納
	$list = array(); //returnする用の配列を作成

	foreach ( $lists as $key => $val ){
		if($val != "." && $val != ".."){ //カレントディレクトリと親ディレクトリは$listに入れないようifを区別している
			$list[] = $val; // "./"と"../"以外を格納
		}
	}
	return $list; // "./と"../"以外が格納された配列を返す
}

function json_writer( $package_id, $dir, $package_name ) { //json形式でパッケージについてファイルを作成・追記する
	/*
	 * 投稿したパッケージの情報を全てをjson形式で保存する関数
	 * @param $package_id 投稿したパッケージのid int
	 * @param $dir この変数には投稿したパッケージのディレクトリパスが格納されている テキスト
	 * 2014/12/13未完成 ( 追々、追加するパラメータが増えるため )
	 */

	$package_text = $dir . '/package.json'; //jsonファイルを書き出す場所とファイル名が格納された変数

		$package_arr = array( //json形式にするために連想配列を作成し値を入れる
				'Package_ID' => $package_id, // 投稿されたパッケージのid
				'Package_Name' => $package_name, //投稿されたパッケージのname
				'Upload_Time' => getTime(), //getTime関数( 自作 )でアップロード時間にするつもり。ただ今後変わる可能性がある
				'Files' => getDrecotory( $dir ), //$dirに格納された、パッケージのディレクトリパスをもとにその中身を関数で取ってきて連想配列に格納する
		);

	file_put_contents( $package_text, json_encode( $package_arr ) ); // $package_arrをjson形式にエンコードされた値を$package_text( $dir の中にpackage.json )に書き込む
}

function getTime(){

	/*
	 * getTimeを呼び出されたときの時間(年/月/日/時/分/秒)を返す関数
	 * @param なし
	 * 2014/12/13完成済み
	 */
	return date('Y/m/d/H/i/s');
}


function package_register ( $filedata, $postdata, $creator_id ) {

	/*
	 * $filePath default = ../tmp
	 * time() で、呼び出された時の時刻を$filePathに追加する
	 * $filePath '/' time() = ../tmp/投稿された時間
	 */

	require_once 'tukue_img_functions.php';
	require_once 'tukue_package_functions.php';

// 	Database_Package_Register($postdata['package_name'], $creator_id,)

	$img_id = getImage_id();

	$time = getTime();

	$filePath = '../tmp';
	$filePath = make_directory( $filePath . '/' . time() );

	Database_Package_Register( $postdata['package_name'], $postdata['package_description'], $creator_id, getTime(), $postdata['package_tag'] );

	$package_id = max( getPackage_id() ); //databaseからt_packageのpackage_idの最大値を取得する
	$package_id = ( $package_id['package_id'] + 1 ); // 取得した最大値に1を足して、t_imgのpackage_idにsetするための値にする

	$all_count = max( getImage_id() ); // databseからt_imgのimg_idを取得して最大を得る
	$all_count = ( $all_count['img_id'] + 1 ); // 取得した最大値に１を足して、画像の連番用にする

	$front_count = 0; //front用要素
	$back_count = 0; //back用要素

	$array_Keys = array_keys( $filedata );

	foreach ($array_Keys as $keys => $vals ){

		if( $vals == "package_image" || $vals == "package_fieldbg" || $vals == "package_handbg"){ //連想配列にならない。パッケージのアイコン、手札の背景、場の背景をforeachで動かさないためのif
			$error = null;

			if( strlen( $filedata[$vals]['type']  ) > 0 ) {
				$imgType = $filedata[$vals]['type'];
				$extension = '';

				if ( $imgType == 'image/gif' ) {
					$extension = 'gif';
				} else if ( $imgType == 'image/png' || $imgType == 'image/x-png' ) {
					$extension = 'png';
				} else if ( $imgType == 'image/jpeg' || $imgType == 'image/pjpeg' ) {
					$extension = 'jpg';
				} else if ( $extension == '' ) {
					$error .= '許可されていない拡張子です。<br />';
				}

				$checkImage = @getimagesize ( $filedata[$vals]['tmp_name']);

				if( $checkImage == FALSE) {
					$error .= '画像ファイルをアップロードしてください。';
				} else if ( $imgType != $checkImage['mime'] ) {
					$error .= '拡張子が異なります。<br />';
				} else if ( $filedata[$vals]['size'] > 10240000 ) {
					$error .= 'ファイルサイズが大きすぎます。10MB以下にしてください。';
				} else if ( $filedata[$vals]['size'] == 0 ) {
					$error .= 'ファイルが存在しないか、空のファイルです。';
				} else if ( $extension != 'gif' && $extension != 'jpg' && $extension != 'png' ) {
					$error .= 'アップロード可能なファイルは、( gif, jpg, png )です。';
				} else {
					$moveTo = $filePath . '/' . $all_count . "." . $extension;

					if(!move_uploaded_file ( $filedata[$vals]['tmp_name'], $moveTo ) ) {
						$error .= '画像のアップロードに失敗しました。';
					}
				}
				if ( $error != '' ) {
					echo $error;
				}
				$all_count;
			}
		} else {
			foreach ( $filedata[$vals]['name'] as $key => $val ){

				$error = null;

				if( strlen( $filedata[$vals]['type'][$key]  ) > 0 ) {
					$imgType = $filedata[$vals]['type'][$key];
					$extension = '';

					if ( $imgType == 'image/gif' ) {
						$extension = 'gif';
					} else if ( $imgType == 'image/png' || $imgType == 'image/x-png' ) {
						$extension = 'png';
					} else if ( $imgType == 'image/jpeg' || $imgType == 'image/pjpeg' ) {
						$extension = 'jpg';
					} else if ( $extension == '' ) {
						$error .= '許可されていない拡張子です。<br />';
					}

					$checkImage = @getimagesize ( $filedata[$vals]['tmp_name'][$key]);

					if( $checkImage == FALSE) {
						$error .= '画像ファイルをアップロードしてください。';
					} else if ( $imgType != $checkImage['mime'] ) {
						$error .= '拡張子が異なります。<br />';
					} else if ( $filedata[$vals]['size'][$key] > 10240000 ) {
						$error .= 'ファイルサイズが大きすぎます。10MB以下にしてください。';
					} else if ( $filedata[$vals]['size'][$key] == 0 ) {
						$error .= 'ファイルが存在しないか、空のファイルです。';
					} else if ( $extension != 'gif' && $extension != 'jpg' && $extension != 'png' ) {
						$error .= 'アップロード可能なファイルは、( gif, jpg, png )です。';
					} else {
						$moveTo = $filePath . '/' . $all_count . '.' . $extension;
						if(!move_uploaded_file ( $filedata[$vals]['tmp_name'][$key], $moveTo ) ) {
							$error .= '画像のアップロードに失敗しました。';
						}
					}
					if ( $error != '' ) {
						echo $error;
					}
				}
				if( $vals == "front" ){
					$front_count++;
				}
				$all_count++;
			}
		}
	}
	echo '登録できました。';
}

 function unzip($zip, $dir){ // zip解凍
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
 }

function text_encoding ( $text ) {

	/*
	 * windwosと他では文字のエンコードが違うので、パッケージの投稿時に変換するための関数です。
	 * @param $text windowsで入力されたり、逆に表示したりする テキスト
	 * 2014/12/13完成済み
	 */

	$encode = "ASCII, JIS, UTF-8, CP932, SJIS-win";

	switch ( mb_detect_encoding( $text, "UTF-8,ASCII, SJIS, JIS-win" ) ) {
		case 'ASCII' :
			mb_language( "Japanese" );
			return mb_convert_encoding( $text, "UTF-8", $encode );
			break;
		case 'SJIS' :
			mb_language( "Japanese" );
			return mb_convert_encoding( $text, 'utf8', $encode );
			break;
		case 'CP932' :
			mb_language( "Japanese" );
			return mb_convert_encoding( $text, 'utf8', $encode );
			break;
		case 'UTF-8' :
			mb_language( "Japanese" );
			return mb_convert_encoding( $text, 'CP932', $encode );
			break;
		default:
			return $text;
			break;
	}
}

function directory_delete( $dir_del ){

	/*
	 * $dirのフォルダを削除する関数
	 * if文でフォルダが存在しなければ、エラーを出す、存在していれば削除を行う
	 * @param $dir_del パスが格納されている テキスト
	 * 2014/12/13完成済み
	 */

	if( file_exists( $dir_del ) ) {
		rmdir( $dir_del );
	} else {
		echo $dir_del . "は存在しません";
	}
}
?>