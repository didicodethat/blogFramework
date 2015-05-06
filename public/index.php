<?php
require "../vendor/autoload.php";
require "../autoload.php";

use \Slim\Slim;
use \Config\Config;
use \Config\Router;

if(!defined('PUBLIC_PATH')){
    define('PUBLIC_PATH',dirname(__FILE__));
}

if(!defined('PROJECT_ROOT')){
    define('PROJECT_ROOT',realpath(PUBLIC_PATH.'/../'));
}

if(!defined('VIEWS_PATH')){
    define('VIEWS_PATH',realpath(PROJECT_ROOT.'/View'));
}

if(!defined('CACHE_PATH')){
    define('CACHE_PATH',realpath(PROJECT_ROOT.'/tmp/cache'));
}

##############################################
function requestIsLocalFile(){
    $extensions = array("jpg", "jpeg", "gif", "css");

    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if (in_array($ext, $extensions)) {
        return true;
    }
};
if(requestIsLocalFile()){
    return false;
}
##############################################

$slimApp = new Slim();
Config::configApp($slimApp);
Router::init($slimApp);
$slimApp->run();