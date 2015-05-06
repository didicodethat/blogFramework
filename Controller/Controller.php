<?php 

namespace Controller;

class Controller{
    public function __construct(\Slim\Slim $slimApp){
        $this->app = $slimApp;
        $this->request = &$this->app->request;
        $this->initRoutes();
    }
    public function initRoutes(){
        
    }
    public function action($actionName = ''){
        if(!method_exists($this,$actionName)){
            throw new \Exception("A função '$actionName' não existe.");
        }
        return array(&$this, $actionName);
    }
}