<?php
namespace Models\BO;
use Models\DAO\UserDAO;
use Models\DTO\UserDTO;
class UserBO extends BO{
    public function save(UserDTO $userDTO){
        $userDAO = new UserDAO();
        $userDAO->conex->beginTransaction();
        try{
            $userDAO->save($userDTO);
        }catch(Exception $ex){
            $userDAO->conex->rollBack();
            throw new Exception($ex->getMessage());
        }
    }

    public function login(UserDTO $userDTO){
        $userDAO = new UserDAO();
        $userDAO->conex->beginTransaction();
        try{
            $userDAO->validateLogin($userDTO);
        }catch(Exception $ex){
            $userDAO->conex->rollBack();
            throw new Exception($ex->getMessage());
        }
    }
}