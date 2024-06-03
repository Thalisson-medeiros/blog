<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{

    public function index()
    {
        $posts = Container::getModel('posts');
        $this->view->posts = $posts->getPosts();

        $posts = Container::getModel('posts');
        $this->view->favoritePosts = $posts->getFavoritePosts();

        $this->render('index');
    }

    public function post()
    {
        $post = Container::getModel('posts');
        $this->view->onePost = $post->getOnePost($_GET['id']);

        $this->render('post-unico');
    }

    public function cadastro()
    {
        $this->render('cadastro');
    }

    public function login()
    {
        $this->render('login');
    }
}