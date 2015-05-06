<?php

namespace Models\DTO;

class PostDTO{
    private $id;
    private $title;
    private $callMessage;
    private $message;
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function getId(){
        return $this->id;
    }
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setCallMessage($callMessage){
        $this->callMessage = $callMessage;
        return $this;
    }
    public function getCallMessage(){
        return $this->callMessage;
    }
    public function setMessage($message){
        $this->message = $message;
        return $this;
    }
    public function getMessage(){
        return $this->message;
    }
}