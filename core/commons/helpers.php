<?php

function app(){
    global $app;
    return $app;
}

function config(){
    global $config;
    return $config;
}

function router(){
    global $router;
    return $router;
}

function env($name, $default = null){
    if(defined($name)){
        return constant($name);
    }else{
        return $default;
    }
}

function view($view_name, $data = null){
    $base_dir="./views/";
    echo "view: "; var_dump($data); echo "<br>";
    if($data){
        extract($data, EXTR_PREFIX_SAME, "view");
    }
    $uri = app()->uri()[0]."/";
    $file = $base_dir.$view_name.".php";
    ob_start();
    if(file_exists($file)){
        require($file);
    }else{
        die("View File: $file does not exists!");
    }
    ob_end_flush();
}

function response_json($data, $http_response_code=200){
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($http_response_code);
    echo json_encode($data);
}