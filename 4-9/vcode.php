<?php
    $url='http://vm.1807api.com/getvcodeurl';
    //初始化
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    //不输出 返回字符串
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    //设置post提交
    curl_setopt($ch,CURLOPT_POST,1);
    //发送请求
    $rs=curl_exec($ch);
//    echo $rs;die;
    if(curl_errno($ch)){
        var_dump(curl_errno($ch));
        var_dump(curl_error($ch));
    }
    $api_arr=json_decode($rs,true);
//    var_dump($api_arr);die;
?>
    <hr>
    <input type="hidden" id="sid" readonly value="<?php echo $api_arr['data']['sid']?>">
    验证码：<img id="code" src="<?php echo $api_arr['data']['url']?>">
    <br>
    <input type="text" placeholder="请输入验证码" name="vcode">
    <input type="button" value="验证验证码" id="vcode">
    <script type="text/javascript" src="./jquery-1.12.4.min.js"></script>
    <script>
        $(function(){
            $('#code').click(function(){
               var img=$('#code').prop('src')+'?r='+Math.random();
                $(this).prop('src',img);
            });
            $('#vcode').click(function(){
                var vcode=$('#vcode');
//                console.log(vcode);
                $.ajax({
                    url : './verify.php',
                    data : 'sid='+$('#sid').val()+'&vcode='+$('[name=vcode]').val(),
                    dataType : 'json',
                    type : 'post',
                    success : function(res){
//                        console.log(res);
//                        $('#vcode').after(res);
                        if(res=1000){
                            alert('验签成功');
                        }else{
                            alert('验签失败');
                        }
                    }
                })
            })
        })
    </script>
