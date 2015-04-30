<?php
namespace Config;

use \Slim\Slim;
use \Controller\PagesController;
use \Middleware\BuilderMiddleware;

class Router{
    private static $slimApp;
    public static function init(){
            self::initMiddlewares();
        self::initControllers();
    }
    public static function initMiddlewares(){
        $slimApp = Slim::getInstance();
        if(Config::runsBuildTasksOnRequests()){
            $slimApp->add(new BuilderMiddleware());
        }
    }
    public static function initControllers(){
        PagesController::initRoutes();
    }
}