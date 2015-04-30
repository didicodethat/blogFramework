<?php
require "../autoload.php";
use \Config\Config;
class ConfigTests extends PHPUnit_Framework_TestCase{
    public function testConfigDependencies(){
        $this->assert(Config::getConfig('system_name'));
    }
    public function testDatabaseSettings(){
        $settings = Config::getDatabaseSettings();
        $this->assertNotNull($settings);
        $this->assertNotEmpty($settings);
        $this->assertArrayHasKey("host", $settings);
        $this->assertArrayHasKey("port", $settings);
        $this->assertArrayHasKey("database", $settings);
        $this->assertArrayHasKey("username", $settings);
        $this->assertArrayHasKey("password", $settings);
    }
}
?>