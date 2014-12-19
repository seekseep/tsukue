<!--
 * hybridauth認証の設定
-->

<?php

return array(
    "base_url" => "http://localhost/Package/hybridauth/",
    "providers" => array(
        "Twitter" => array(
            "enabled" => true,
            "keys" => array(
                "key" => "[your app's consumer key]",
                "secret" => "[your app's consumer secret]"
            )
        )
    )
);