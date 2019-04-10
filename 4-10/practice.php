<?php
    function test($m){
        $a[0]=1;
        for($i=1;$i<$m;$i++){
            if($i%2==0){
                $a[$i]=$a[$i-1]*$a[$i-1];    //奇数 翻倍
            }else{
                $a[$i]=$a[$i-1]+1;           //偶数 +1
            }
        }
        return $a[$m-1];
    }
    print_r(test(7));