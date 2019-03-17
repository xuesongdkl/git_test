<?php
    //文件上传
    //初始化
    $ch = curl_init();
    //设置抓取的url
//    curl_setopt($ch, CURLOPT_URL, 'https://vm.lening.com/test/curl1');
    $data=[
        'name'  =>   'dkl',
        'img'   =>   new CURLFile('123.jpg')
    ];
    curl_setopt($ch, CURLOPT_URL, 'http://vm.lening.com/test/curl1?xs=20');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//    var_dump($data);die;
//    $res=file_put_contents('curl1.html',$data,FILE_APPEND);    //保存页面
    curl_exec($ch);
     //关闭URL请求
     curl_close($ch);
     //显示获得的数据
    print_r($data);
