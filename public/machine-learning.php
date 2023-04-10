<?php

function classify_image($image_path){

    $url = 'http://127.0.0.1:5000/EEG';
    $data = array('path' => $image_path);
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $result = json_decode($result, true);
    return $result;
}

?>
