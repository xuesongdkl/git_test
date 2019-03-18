<?php
    //CBC算法
    $str='hello world';
    $key='pass';
    $iv=mt_rand(11111,99999).'ssssfffffae';      //初始化向量   固定16字节
    //加密
    $enc_str=openssl_encrypt($str,'AES-128-CBC',$key,OPENSSL_RAW_DATA,$iv);
    var_dump($enc_str);
    echo "<hr>";

    //解密
    $dec_str=openssl_decrypt($enc_str,'AES-128-CBC',$key,OPENSSL_RAW_DATA,$iv);
    echo $dec_str;