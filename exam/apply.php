<?php
//    print_r($_POST);die;
    $name = $_POST['name'];
    $idcard = $_POST['idcard'];
    $appuse = $_POST['appuse'];
    if(!empty($name||$idcard||$appuse)){
        $card=substr($idcard,3,12);
        $time=substr(time(),4,3);
        $app_key=$card.$time;
        $app_secret=substr($app_key,5,10).mt_rand(10000,99999);
        $data=[
            'app_key' =>$app_key,
            'app_secret' =>$app_secret
        ];
        $now=time();
        $url='http://vm.lening.com/test/apply?t='.$now;
        $key='love';
        $salt='sssss';
        $method='AES-128-CBC';
        $iv=substr(md5($now.$salt),5,16);
        $json_str=json_encode($data);
        $enc_data=openssl_encrypt($json_str,$method,$key,OPENSSL_RAW_DATA,$iv);
        $post_data=base64_encode($enc_data);
//    var_dump($post_data);die;
        $curl = curl_init();                                //初始化
        curl_setopt($curl, CURLOPT_URL,$url);               //设置抓取的url
        curl_setopt($curl, CURLOPT_POST, 1);              //设置post方式提交
        curl_setopt($curl, CURLOPT_POSTFIELDS,['data'=>$post_data]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);    //设置获取的信息以文件流的形式返回，而不是直接输出
        curl_setopt($curl, CURLOPT_HEADER, 0);              //设置头文件的信息作为数据流输出
        $rs = curl_exec($curl);
//    var_dump($rs);
        $response=json_decode($rs,true);
        print_r($response);
    }