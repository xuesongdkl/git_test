<?php
    //非对称加密
    function rsaEncrypt($str){
        $i=0;
        $all='';
        while ($sub_str=substr($str,$i,117)){
            openssl_public_encrypt($sub_str,$encrypt_data,file_get_contents(__DIR__.'/public.key'),OPENSSL_PKCS1_PADDING);
            $all .= base64_encode($encrypt_data);
            $i+=117;
        }
        return $all;
    }
    //非对称解密
    function rsaDecrypt($decrype_data){
        $i=0;
        $all='';
        while ($sub_str=substr($decrype_data,$i,172)){
            $decode_data=base64_decode($sub_str);
            openssl_public_decrypt($decode_data,
                $decrypt_data,
                file_get_contents(__DIR__.'/public.key'),
                OPENSSL_PKCS1_PADDING);
            $all .=$decrypt_data;
            $i+=172;
        }
        return $all;
    }

    //申请app_id和app_secret
    $app_id=md5(0614);
    $app_key=md5('12070614');
    //组装参数
    $param=[
        'name' => 'xuesong',
        'pwd'  => '12070614',
        'age'  => 20,
        'app_id'=> $app_id
    ];
//    var_dump($param);die;
    $api_param=[];
    //数据加密
//    $encrypt_data=openssl_encrypt(json_encode($param),'AES-256-CBC','dkllove',false,'0614668812076688');
    $encrypt_data=rsaEncrypt(json_encode($param));
//    echo $encrypt_data;die;
    $api_param['data']=$encrypt_data;
    //参数排序
    ksort($param);
    //把参数转换为a=1&b=2
    $str=http_build_query($param);
    //生成签名
    $sign=md5($str.'&app_key='.$app_key);
    //在请求的数组中加上签名
    $api_param['sign']=$sign;
//    print_r($api_param);

    $ch=curl_init();
    $url='http://vm.1807api.com/test';
    curl_setopt($ch,CURLOPT_URL,$url);
    //不输出 返回字符串
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    //设置post提交
    curl_setopt($ch,CURLOPT_POST,1);
    //设置post提交字段
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($api_param));
    //发送请求
    $rs=curl_exec($ch);
//    echo $rs;
//    die;
    if(curl_errno($ch)){
        var_dump(curl_errno($ch));
        var_dump(curl_error($ch));
    }

    $api_arr=json_decode($rs,true);
    //解密
    $dec_data=rsaDecrypt($api_arr['data']);
//    $dec_data=openssl_decrypt($api_arr['data'],'AES-256-CBC','dkllove',false,'0614668812076688');
    $result=json_decode($dec_data,true);
    var_dump($result);
    ksort($result);
    $sign=md5(http_build_query($result).'&app_key='.$app_key);
    if($sign==$api_arr['sign']){
        echo "ok";
    }else{
        echo "被修改过";
    }

    die;