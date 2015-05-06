<?php 

namespace Models\DTO;

use \Helper\SecurityHelper;

class UserDTO{
    private $id;
    private $username;
    private $password;
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }
    public function getPassword(){
        return SecurityHelper::hashPassword($this->password);
    }
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }
}