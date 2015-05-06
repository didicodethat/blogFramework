<?php

namespace Controller;

class PagesController extends Controller{
    public function initRoutes(){
        $this->app->get('/', $this->action('index'));
    }
    public function index(){
        $this->app->render('index.twig.html');
    }
}