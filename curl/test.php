<?php
    $content=file_get_contents('curl1.html');
    $patten='/<link href="(.*)">/';
    preg_match_all($patten,$content,$arr);
    print_r($arr);