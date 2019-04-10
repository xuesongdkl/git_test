<?php
    $a=array(1,2,3,4,5,6,7);
    foreach($a as $k=>$v){
        if($v%2==1){
            $data[$k][]=$v;
        }else{
            $data[$k-1][]=$v;
        }
    }
    print_r($data);
    echo "<hr>";

    $arr[0]=$arr[1]=1;
    for($i=2;$i<30;$i++){
        $arr[$i]=$arr[$i-1]+$arr[$i-2];
    }
    $str=implode(' ',$arr);
    echo $str;