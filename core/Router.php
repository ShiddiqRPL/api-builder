<?php

namespace Apps;

class Router{

    public $params = [];
    public $uri = [];
    private $routes = [];

    function buildInRoute(){
        return [
            'maker'=>'Maker',
            'model'=>'RestApi',
        ];
    }

    function parseRequest(){
        $routes = $this->buildInRoute();

        require_once('./config/route.php');
        $this->routes = $routes;

        $url = parse_url($_SERVER['REQUEST_URI']);
        $uri = trim($url['path'],"/");
        $this->uri = explode("/", $uri);
        
        $this->loadQuery($url);
        $this->loadHandler();
    }

    function loadQuery($url){
        if ($url != '/') {
            if(isset($url['query'])){
                parse_str($url['query'], $queries);
                $this->params = $queries;
            }
        }
    }

    function loadHandler(){
        if(count($this->uri) >= 1){
            $route = implode("//",$this->uri);
        }
        if(!$route){
            $route = "home";
        }

        if (!isset($this->routes[$route])){
            $route = "errors";
        }
        $handler = $this->routes[$route];
        if(is_callable($handler)){
            $output = $handler();
            if($output){
                echo $output;
            }
        }else{
            if(!is_array($handler)){
                $handler = explode('@',$handler);
            }
            
            if(count($handler) >= 1){
                $class_name = $handler[0];
                $class_file_name = $handler[0];
                if(strpos($handler[0],"Apps\\Controllers\\") !== -1){
                    $class_file_name = str_replace("Apps\\Controllers\\", "", $handler[0]);
                } else {
                    $class_name = "Apps\\Controllers\\".$class_name;
                }
                if(file_exists(__DIR__.'/../controllers/'.$class_file_name.'.php')){
                    require_once(__DIR__.'/../controllers/'.$class_file_name.'.php');
                    $controller = new $class_name();
                    $action = "index";
                    if(count($handler) > 1 && is_string($handler[1])){
                        $action = $handler[1];
                    }
                    if(method_exists($controller, $action)){
                        $params = ["test",1,false];
                        return call_user_func_array( array($controller, $action), $params);
                    }else{
                        return view('errors/error',['message'=>"Class ".$handler[0]." does not have $action function!"]);
                    }
                }else{
                    return view('errors/error',['message'=>"Class ".$handler[0]." not found!"]);
                }
            }
        }
    }

    function uri(){
        return $this->uri;
    }
}