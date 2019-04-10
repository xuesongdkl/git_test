<?php
    $url='http://vm.lening.com/test/sign1';
    $data=[
        'name'  =>  '杜凯龙',
        'age'   =>  19,
        'hobby' =>  'play bastketball'
    ];
    $json_data=json_encode($data);
    //计算签名
    $priKey = openssl_pkey_get_private(file_get_contents("rsa_private_key.pem"));
    openssl_sign($json_data,$signature,$priKey,OPENSSL_ALGO_SHA256);

    //释放资源
    openssl_free_key($priKey);
    $sign=base64_encode($signature);

    //向服务端发送数据
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,['sign'=>$sign,'data'=>$json_data]);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $rs=curl_exec($ch);
    var_dump($rs);