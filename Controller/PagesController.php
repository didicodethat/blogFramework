<?php
namespace Controller;
use \Slim\Slim;
use \Models\DAO\UserDAO;
class PagesController{
    public static function initRoutes(){
        $slimApp = Slim::getInstance();
        $slimApp->get('/', get_class().'::index');
    }
    public static function index(){
        $slimApp = Slim::getInstance();
        $slimApp->render('index.twig.html');
    }
}