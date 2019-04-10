<?php
    $arr[0]=1;
    $arr[1]=1;
    for($i=2;$i<30;$i++){
        $arr[$i]=$arr[$i-1]+$arr[$i-2];
    }
    echo implode('<br>',$arr);

