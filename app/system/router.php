<?php

namespace bng\System;
use bng\Controllers\Main;
use Exception;

class Router
{
    public static function dispatch()
    {
        // main route values
        $httpverb = $_SERVER['REQUEST_METHOD'];
        $controller = 'Main';
        $method = 'index';

        // check url parameters

        if(isset($_GET['ct'])){
            $controller = $_GET['ct'];
        }

        if(isset($_GET['mt'])){
            $method = $_GET['mt'];
        }
         
        // method parameters

        $parameters = $_GET;

        // remove controller from parameter

        if(key_exists("ct", $parameters)){
            unset($parameters['ct']);
        }

        if(key_exists("mt", $parameters)){
            unset($parameters['mt']);
        }

        // tries to instanciate the controller and execute the method

        try{
            $class = "bng\Controllers\\$controller";
            $controller = new $class();
            $controller->$method(...$parameters);
        } catch(Exception $err) {
            die($err->getMessage());
        }

    }
}