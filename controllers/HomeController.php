<?php 

namespace Apps\Controllers;

class HomeController {
    function index($a, $b, $c){
        return response_json(["app"=> "api-builder v0.0.1", "status"=> "Running"],200);
    }
}