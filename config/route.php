<?php 

use Apps\Controllers\HomeController;

$routes['test-view'] = function(){
    return view('test/functions');
};
$routes['test-function'] = function(){
    return "test-function";
};
$routes['home'] = [HomeController::class,'index'];
$routes['errors'] = function(){
    return view('errors/error');
};