<?php 

namespace Controller;

class PostsController extends Controller {
    public function initRoutes(){
        $this->app->get('/escrever/postagem', $this->action('escreverPostagem'));
        $this->app->post('/salvar/postagem', $this->action('salvarPostagem'));
    }
    public function escreverPostagem(){
        $this->app->render('formularios/escrever.postagem.twig.html');
    }
    public function salvarPostagem(){
        $postBO = new \Models\BO\PostBO(new \Models\DAO\PostDAO());
        $post = new \Models\DTO\PostDTO();
        $post
            ->setTitle($this->request->post('title'))
            ->setCallMessage($this->request->post('call_message'))
            ->setMessage($this->request->post('message'));
        $postBO->save($post);
    }
}