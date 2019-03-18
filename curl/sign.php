<?php
    $url = "http://vm.lening.com/test/sign";
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);
    $rs=curl_exec($ch);
//    echo $rs;
    $response=json_decode($rs,true);
    var_dump($response);

    $pubKey = file_get_contents("rsa_public_key.pem");
    $pubKey = wordwrap($pubKey, 64, "\n", true) ;
    $res = openssl_get_publickey($pubKey);
    ($res) or die('您使用的公钥格式错误，请检查RSA公钥配置');

    $result = (openssl_verify(json_encode($response['data']), base64_decode($response['sign']), $res, OPENSSL_ALGO_SHA256)===1);
    openssl_free_key($res);
    var_dump($result) ;

