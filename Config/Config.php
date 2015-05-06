<?php

namespace Config;

use \Helper\FilesHelper;

class Config{
    public static $config;
    
    public static function getConfig($key = ''){
        if(!self::$config){
            $configFile = FilesHelper::readJSONFile(__DIR__.'/config.json');
            if(!$configFile){
                throw new \Exception(
                    "Arquivo de configuração não encontrado. "
                    . "Certifique-se de que o arquivo 'config.json' está presente na pasta Config"
                    . "e que o json é válido"
                );
            }
            self::$config = $configFile;
        }
        if($key){
            return self::$config[$key];
        }else{
            return self::$config;
        }
    }

    public static function configApp(\Slim\Slim $slimApp){
        $slimApp->log->setEnabled(self::savesLogMessages());
        self::configAppView($slimApp);
    }

    public static function configAppView(\Slim\Slim $slimApp){
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

    public static function getDatabaseSettings($key = null){
        $databaseConfig = self::getConfig('database');
        if($key === null){
            return $databaseConfig;
        }else{
            return $databaseConfig[$key];
        }
    }

    public static function getDatabaseConnection(){
        $connection = new \PDO(
            self::getDatabaseFullURL(),
            self::getDatabaseSettings('username'),
            self::getDatabaseSettings('password')
        );
        $connection->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        
        return $connection;
    }
    public static function getDatabaseFullURL(){
        $databaseConfig = self::getDatabaseSettings();
        return 'mysql:'. 'host=' 
                . $databaseConfig['host']
                . ($databaseConfig['port'] ? ':'.$databaseConfig['port'] : '')
                . ';dbname=' . $databaseConfig['database'].';charset=UTF8';
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