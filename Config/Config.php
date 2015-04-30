<?php
namespace Config;
use \Helper\FilesHelper;
use \Slim\Slim;

class Config{
    public static $config;
    
    public static function getConfig($key = ''){
        if(!self::$config){
            self::$config = FilesHelper::readJSONFile(__DIR__.'/config.json');
        }
        if($key){
            return self::$config[$key];
        }else{
            return self::$config;
        }
    }

    public static function configApp(){
        $slimApp = Slim::getInstance();
        $slimApp->log->setEnabled(self::savesLogMessages());
        self::configAppView();
    }

    public static function configAppView(){
        $slimApp = Slim::getInstance();
        $view = new \Slim\Views\Twig();
        $view->parseOptions  = array(
            'strict_variables' => false,
            'charset' => 'utf-8',
            'auto_reload' => true,
            'debug' => true,
            'cache' => CACHE_PATH
        );
        $slimApp->view($view);
        $slimApp->view()->setTemplatesDirectory(VIEWS_PATH);
    }

    public static function getDatabaseSettings(){
        return self::getConfig('database');
    }

    public static function getDatabaseConnection(){
        $databaseConfig = self::getDatabaseSettings();
        return new \PDO(
            'mysql:'. 'host=' 
                . $databaseConfig['host']
                . ($databaseConfig['port'] ? ':'.$databaseConfig['port'] : '')
                . ';dbname=' . $databaseConfig['database'].';charset=UTF8',
            $databaseConfig['username'], 
            $databaseConfig['password']
        );
    }

    /* ==============================================
     * Reading Specific Configuration
     * ============================================== */

    public static function savesLogMessages(){
        return (bool) self::getConfig('save_log_messages');
    }

    public static function runsBuildTasksOnRequests(){
        return (bool) self::getConfig('run_build_tasks_on_request');
    }
}