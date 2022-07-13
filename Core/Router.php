<?php
namespace App\Core;

use App\Controller\DefaultController;
use App\Controller\ErrorController;

class Router
{
    public function start()
    {
        // start the session
        session_start();

        // remove the trailing slash
        $uri = $_SERVER['REQUEST_URI'];
        if(!empty($uri) && $uri != '/' && $uri[-1] === "/"){

            // remove the /
            $uri = substr($uri, 0, -1);

            // redirection code
            http_response_code(301);

            // redirection
            header('Location: '.$uri);
            die();
        }

        // deal with the parameters (p=controller/method/parameters)
        // explode the parameters in an array
        $params = [];
        if (isset($_GET['p'])) {
            $params = explode('/', $_GET['p']);
        }

        // var_dump($params);
        if($params[0] != ''){
            // there is at least one parameter
            // generate the name of the controller to instantiate
            $controller = '\\App\\Controller\\'.ucfirst(array_shift($params)).'Controller';

            // class exists ?
            if (class_exists($controller)) {
                $controller = new $controller();
            } else {
                // class doesn't exist, return 404 and display 404 template
                http_response_code(404);
                $controller = new DefaultController;
                $controller->error404();
                die();
            }

            // get the 2nd URL parameter
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            // method exists ?
            if(method_exists($controller, $action)){
                // if there are others parameters, send them to the method
                (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
            }else{
                // method doesn't exist, return 404 and display 404 template
                http_response_code(404);
                $controller = new DefaultController;
                $controller->error404();
                die();
            }

        }else{
            // no parameters : default controller, display the home page
            $controller = new DefaultController;
            $controller->index();
        }
    }
}