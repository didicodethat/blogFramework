<?php

namespace Models\BO;

use \Models\DTO\UserDTO;

class UserBO extends BO{
    
    public $userDAO;

    public function __construct(\Models\DAO\DAO $userDAO){
        $this->userDAO = $userDAO;
        $this->conex = $userDAO->conex;
    }

    public function save(UserDTO $userDTO){
        $this->conex->beginTransaction();
        try{
            $this->userDAO->save($userDTO);
            $this->conex->commit();
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    public function login(UserDTO $userDTO){
        $this->conex->beginTransaction();
        try{
            $this->userDAO->validateLogin($userDTO);
        }catch(\Exception $ex){
            $this->conex->rollBack();
            throw new \Exception($ex->getMessage());
        }
    }
    
}