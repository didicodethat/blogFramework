<?php
namespace Models\BO;

class BO{
    public function __construct(){
        $this->conex = Config::getDatabaseConnection();
    }
}