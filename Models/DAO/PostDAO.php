<?php 
namespace Models\DAO;

use \Models\DTO\PostDTO;

class PostDAO extends DAO{
    $tableName = "posts";
    public function save(PostDTO $post){
        try{
            $query = $this->conex->prepare(
                "INSERT INTO {$this->tableName} (title, call_message, message)
                 VALUES (:title, :call_message, :message)"
            );
            $query->execute(array(
                ':title' => $post->getTitle(),
                ':call_message' => $post->getCallMessage(),
                ':message' => $post->getMessage()
            ));
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }
}