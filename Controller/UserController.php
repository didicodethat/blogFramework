<?php

namespace Controller;

class UserController extends Controller{
    public function initRoutes(){
        $this->app->get('/cadastrar', $this->action('cadastrarUsuario'));
        $this->app->post('/salvar/usuario', $this->action('salvarUsuario'));
    }
    public function cadastrarUsuario(){
        $this->app->render('formularios/cadastrar.usuario.twig.html');
    }
    public function salvarUsuario(){
        $userDTO = new \Models\DTO\UserDTO();
        $userBO = new \Models\BO\UserBO(new \Models\DAO\UserDAO);
        $userDTO
            ->setUsername($this->request->post('username'))
            ->setPassword($this->request->post('password'));
        try{
            $userBO->save($userDTO);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}