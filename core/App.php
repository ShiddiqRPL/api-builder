<?php 

namespace Apps;

use Apps\Router;

class App {
    private $router = null;

    function run() {
        $this->router = new Router();
        $handler = $this->router->parseRequest();
    }

    function uri(){
        return $this->router->uri();
    }

}