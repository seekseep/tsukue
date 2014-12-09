<?php
if (is_uploaded_file($_FILES["img_front"]["tmp_name"])) {

	echo $_FILES["img_front"]["tmp_name"];
	echo $_FILES["img_front"]["name"];
exit();
  if (move_uploaded_file($_FILES["img_front"]["tmp_name"], "../tmp/" . $_FILES["img_front"]["name"])) {
	
    chmod("files/" . $_FILES["img_front"]["name"], 0644);
    echo $_FILES["img_front"]["name"] . "をアップロードしました。";
  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}
?>
