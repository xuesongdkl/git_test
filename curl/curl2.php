<?php
    $url = "http://localhost/post_output.php";

    $post_data = array (
        "foo" => "bar",
        "query" => "Nettuts",
        "action" => "Submit"
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // 我们在POST数据哦！
    curl_setopt($ch, CURLOPT_POST, 1);
    // 加上POST变量
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

    $output = curl_exec($ch);
    curl_close($ch);

    echo $output;