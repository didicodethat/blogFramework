<?php

namespace Middleware;

class BuilderMiddleware extends \Slim\Middleware{
    public function call(){
        $this->buildJavascriptFiles();
        $this->next->call();
    }
    public function buildJavascriptFiles(){
        
    }
}