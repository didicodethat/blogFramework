<?php

namespace Models\BO;

use Models\DTO\PostDTO;
use Models\DAO\PostDAO;

class PostBO extends BO{
    public function __construct(\Models\DAO\DAO $postDAO){
        $this->postDAO = $postDAO;
        $this->conex = $postDAO->conex;
    }
    public function save(PostDTO $post){
        $this->conex->beginTransaction();
        try{
            $this->postDAO->save($post);
            $this->conex->commit();
        }catch(\Exception $ex){
            $this->conex->rollBack();
            throw new \Exception($ex->getMessage());
        }
    }
}