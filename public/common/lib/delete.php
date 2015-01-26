<?php
require_once 'api/tukue_creator_functions.php';
require_once 'api/tukue_package_functions.php';
require_once 'api/tukue_img_functions.php';
require_once 'api/tukue_object_functions.php';

var_dump( $_POST );


/**
 * パッケージidからt_objectのf_img_idとb_img_idを取得
 * select f_img_id, b_img_id FROM t_objet where package_id
 *
 *  取得したらt_imgの取得したid全消去
 *  delete  from t_img where (f_img_id, b_img_id)
 *
 *    t_objectをpackage_idをもとに削除
 *    delete from t_object where package_id
 *
 *  t_packageを削除
 *  delete from t_package where package_id
 *
 */