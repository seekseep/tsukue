<?php

function toJson ( $data ) {
	/*
	 * $dataをjson形式にして返す関数 2014/12/13完成済み $data 連想配列
	 */
	header( 'Content-type: application/json; charset=utf-8' ); // ここから先はjsonであることを示すので、jsonするときはこれを書こう！
	return json_encode( $data, JSON_UNESCAPED_UNICODE ); // jsonにエンコードする/
	exit();
}

function make_directory ( $dir ) {

	/*
	 * ディレクトリ作成関数 この関数が呼び出されたとき、$dir変数とgetTime関数をもとにディレクトリがなければディレクトリを作成します。 ../や./は有効です。 @param
	 * $dir ディレクトリのパス テキスト 2014/12/13完成済み
	 */
	while ( 1 ) {
		$time = getTime();
		$dirpath = null;
		$dirpath = $dir . "/" . $time;

		if ( ! is_file( $dirpath ) ) { // $dirがファイルかどうか falseなら以下を処理
			if ( ! file_exists( $dirpath ) ) { // $dirが存在するかどうか存在しないなら以下を処理
				if ( @mkdir( $dirpath, 0755 ) ) {
					$package_array = array(
							"time" => $time,
							"package_path" => $dirpath
					);
					break;
				} else {
					sleep( 1 );
				}
			} else {
				sleep( 1 );
			}
		}
	}
	return $package_array;
}

function getFile_list ( $dir ) {

	/*
	 * $dirのディレクトリ内の一覧を返す ./や../は無効 @param $dir ディレクトリのパス テキスト 2024/12/13完成済み
	 */
	$lists = scandir( $dir ); // ディレクトリの中身を$listsに配列で格納
	$list = array(); // returnする用の配列を作成

	foreach ( $lists as $key => $val ) {
		if ( $val != "." && $val != ".." ) { // カレントディレクトリと親ディレクトリは$listに入れないようifを区別している
			$list[] = $val; // "./"と"../"以外を格納
		}
	}
	return $list; // "./と"../"以外が格納された配列を返す
}

function getTime () {

	/*
	 * getTimeを呼び出されたときの時間(年/月/日/時/分/秒)を返す関数 @param なし 2014/12/13完成済み
	 */
	return date( 'Y-m-d-H-i-s' );
}

function image_check ( $filedata, $creator_name ) {
	require_once 'tukue_img_functions.php';

	$all_count = ( int ) getIncrementNum(); // getincrementNumでAuto_incrementの値を取得

	$filePath = null;
	$filePath = '../../common/package';

	$package_array = make_directory( $filePath );

	$filePath = $package_array[ "package_path" ];

	foreach ( $filedata as $key => $val ) {

		$count = 1;

		if ( $key == "package_image" || $key == "package_fieldbg" || $key == "package_handbg" ) {
			/*
			 * front, back以外の画像はこっちで処理 $key -> front, back, package_image, package_fieldbg,
			 * package_handbg $keys -> 配列の要素
			 */

			switch ( $key ) {
				case "package_image":
					$package_array = array_merge( $package_array, array(
							"package_image" => $all_count
					) );
					break;
				case "package_fieldbg":
					$package_array = array_merge( $package_array, array(
							"package_fieldbg" => $all_count
					) );
					break;
				case "package_handbg":
					$package_array = array_merge( $package_array, array(
							"package_handbg" => $all_count
					) );
					break;
			}
			$error = '';

			if ( strlen( $filedata[ $key ][ 'name' ] ) > 0 ) {

				$imgType = $filedata[ $key ][ 'type' ];

				$extension = '';
				// 画像タイプの判別
				if ( $imgType == 'image/gif' ) {
					$extension = 'gif';
				} else if ( $imgType == 'image/png' || $imgType == 'image/x-png' ) {
					$extension = 'png';
				} else if ( $imgType == 'imagejpeg' || $imType == 'image/pjpeg' ) {
					$extension = 'jpg';
				} else if ( $extension == '' ) {
					$error .= "許可されていない拡張子です。<br />";
				}

				$checkImage = @getimagesize( $filedata[ $key ][ 'tmp_name' ] );

				if ( $checkImage == FALSE ) {
					$error .= "画像ファイルをアップローしてください。<br />";
				} else if ( $imgType != $checkImage[ 'mime' ] ) {
					$error .= "拡張子が異なります。<br />";
				} else if ( $filedata[ $key ][ 'size' ] > 10240000 ) {
					$error .= "ファイルサイズが大きすぎます。10MB以下にしてください。<br />";
				} else if ( $filedata[ $key ][ 'size' ] == 0 ) {
					$error .= "ファイルが存在しないか、空のファイルです。<br />";
				} else if ( $extension != 'gif' && $extension != 'jpg' && $extension != 'png' ) {
					$error .= "アップロード可能なファイルは git, jpg, png です<br />";
				} else {
					$moveTo = $filePath . '/' . $all_count . '.' . $extension;
					image_Register( $moveTo );
					$all_count ++;
					if ( ! move_uploaded_file( $filedata[ $key ][ 'tmp_name' ], $moveTo ) ) {
						$error .= "画像のアップロードに失敗しました。<br />";
					}
				}
			}
		} else {
			/*
			 * front, backはこっちで処理
			 */
			$error = '';

			foreach ( $filedata[ $key ][ "name" ] as $keys => $vals ) {

				if ( strlen( $filedata[ $key ][ 'name' ][ $keys ] ) > 0 ) {

					$imgType = $filedata[ $key ][ 'type' ][ $keys ];
					$extension = '';

					// 画像タイプの判別
					if ( $imgType == 'image/gif' ) {
						$extension = 'gif';
					} else if ( $imgType == 'image/png' || $imgType == 'image/x-png' ) {
						$extension = 'png';
					} else if ( $imgType == 'imagejpeg' || $imgType == 'image/pjpeg' ) {
						$extension = 'jpg';
					} else if ( $extension == '' ) {
						$error .= "許可されていない拡張子です。<br />";
					}
					$checkImage = @getimagesize( $filedata[ $key ][ 'tmp_name' ][ $keys ] );
					if ( $checkImage == FALSE ) {
						$error .= "画像ファイルをアップローしてください。<br />";
					} else if ( $imgType != $checkImage[ 'mime' ] ) {
						$error .= "拡張子が異なります。<br />";
					} else if ( $filedata[ $key ][ 'size' ][ $keys ] > 10240000 ) {
						$error .= "ファイルサイズが大きすぎます。10MB以下にしてください。<br />";
					} else if ( $filedata[ $key ][ 'size' ][ $keys ] == 0 ) {
						$error .= "ファイルが存在しないか、空のファイルです。<br />";
					} else if ( $extension != 'gif' && $extension != 'jpg' && $extension != 'png' ) {
						$error .= "アップロード可能なファイルは git, jpg, png です<br />";
					} else {
						$moveTo = $filePath . '/' . $all_count . '.' . $extension;
						image_Register( $moveTo );
						$package_array += array(
								( $key . $count ) => $all_count
						);
						$all_count ++;
						if ( ! move_uploaded_file( $filedata[ $key ][ 'tmp_name' ][ $keys ], $moveTo ) ) {
							$error .= "画像のアップロードに失敗しました。<br />";
						}
					}
				}
				$count ++;
			}
		}
	}
	return $package_array;
}

function package_register ( $filedata, $postdata, $creator_id ) {

	/*
	 * $filePath default = ../tmp time() で、呼び出された時の時刻を$filePathに追加する $filePath '/' time() =
	 * ../tmp/投稿された時間
	 */
	require_once 'tukue_img_functions.php';
	require_once 'tukue_package_functions.php';
	require_once 'tukue_object_functions.php';

	// $creator_name = $_SESSION['creator_name'];
	$creator_name = 'test';

	$count = 1;
	$front_count = 0; // front用要素
	$back_count = 0; // back用要素

	if ( is_array( $filedata ) ) {
		$package = image_check( $filedata, $creator_name );
	}

	$result = Database_Package_Register( $postdata[ 'package_name' ], $postdata[ 'package_description' ], $creator_id, $package[ 'time' ],
			$postdata[ 'package_tag' ], $package[ "package_image" ], $package[ "package_handbg" ], $package[ "package_fieldbg" ] );

	if ( $result ) {
		$package_id = getMaxId();
		while ( isset( $package[ 'front' . $count ] ) ) {
			$result = Object_Register( $package_id, $package[ ( 'front' . $count ) ], $package[ ( 'back' . $count ) ] );
			$count++;
		}
		if ( $result ) {
			return $result;
		}
	} else {
		return $result;
	}
}

function text_encoding ( $text ) {

	/*
	 * windwosと他では文字のエンコードが違うので、パッケージの投稿時に変換するための関数です。 @param $text windowsで入力されたり、逆に表示したりする テキスト
	 * 2014/12/13完成済み
	 */
	$encode = "ASCII, JIS, UTF-8, CP932, SJIS-win";

	switch ( mb_detect_encoding( $text, "UTF-8,ASCII, SJIS, JIS-win" ) ) {
		case 'ASCII':
			mb_language( "Japanese" );
			return mb_convert_encoding( $text, "UTF-8", $encode );
			break;
		case 'SJIS':
			mb_language( "Japanese" );
			return mb_convert_encoding( $text, 'utf8', $encode );
			break;
		case 'CP932':
			mb_language( "Japanese" );
			return mb_convert_encoding( $text, 'utf8', $encode );
			break;
		case 'UTF-8':
			mb_language( "Japanese" );
			return mb_convert_encoding( $text, 'CP932', $encode );
			break;
		default:
			return $text;
			break;
	}
}

function directory_delete ( $dir_del ) {

	/*
	 * $dirのフォルダを削除する関数 if文でフォルダが存在しなければ、エラーを出す、存在していれば削除を行う @param $dir_del パスが格納されている テキスト
	 * 2014/12/13完成済み
	 */
	if ( file_exists( $dir_del ) ) {
		rmdir( $dir_del );
	} else {
		echo $dir_del . "は存在しません";
	}
}
?>
