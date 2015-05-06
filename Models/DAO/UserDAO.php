<?php

namespace Models\DAO;

use \Config\Config;

class UserDAO extends DAO{
    public $tableName = "users";
    public function save(\Models\DTO\UserDTO $user){
        try{
            $query = $this->conex->prepare("INSERT INTO {$this->tableName} (username,password) VALUES (:username,:password)");
            $query->execute(array(
                ':username' => $user->getUsername(),
                ':password' => $user->getPassword()
            ));
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }
    public function getUserById($id, $columnsAndAliases = array()){
        try{
            $cols = $this->selectColumnsString($columnsAndAliases);
            return $this->conex->query("SELECT $cols from {$this->tableName} where id = '$id'");
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }
    public function getUserByUsername($username = '', $columnsAndAliases = array()){
        try{
            $cols = $this->selectColumnsString($columnsAndAliases);
            return $this->conex->query("SELECT $cols from {$this->tableName} where username = '$username'");
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }
    public function listUsers($columnsAndAliases = array(), $whereString = '', $columnsAndOrders = array(), $start = null, $end = null){
        try{
            $query = $this->simpleConexQuery($columnsAndAliases, $this->tableName, $whereString, $columnsAndOrders, $start, $end);
            return $query;
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }
    public function validateLogin($username = '', $password = '', $columnsAndAliases = array()){
        try {
            $query = $this->simpleConexQuery($columnsAndAliases, $this->tableName, "username='$username' AND password='$password'");
            return $query->fetchObject();
        } catch (\Exception $e) {
            throw new \Exception($ex->getMessage());
        }
    }
}