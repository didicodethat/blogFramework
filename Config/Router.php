<?php
namespace Config;

use \Middleware\BuilderMiddleware;

class Router{
    public static function init(\Slim\Slim $slimApp){
        self::initMiddlewares($slimApp);
        self::initControllers($slimApp);
    }
    public static function initMiddlewares(\Slim\Slim $slimApp){
        if(Config::runsBuildTasksOnRequests()){
            $slimApp->add(new BuilderMiddleware());
        }
    }
    public static function initControllers(\Slim\Slim $slimApp){
        new \Controller\PagesController($slimApp);
        new \Controller\UserController($slimApp);
        new \Controller\PostsController($slimApp);
    }
}