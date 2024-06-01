<?php
//arquivo para configurar as rotas do framework

namespace App;
use MF\Init\Bootstrap;

class Routes extends Bootstrap
{
    protected function initRoutes(): void
    {
        $route['home'] = [
            'route' => '/',
            'controller' => 'IndexController',
            'action' => 'index'
        ];

        $route['post'] = [
            'route' => '/post',
            'controller' => 'IndexController',
            'action' => 'post'
        ];
        
        $route['cadastro'] = [
            'route' => '/cadastro',
            'controller' => 'IndexController',
            'action' => 'cadastro'
        ];        
        
        $route['login'] = [
            'route' => '/login',
            'controller' => 'IndexController',
            'action' => 'login'
        ];        

        $route['cadastrar'] = [
            'route' => '/cadastrar',
            'controller' => 'AuthController',
            'action' => 'cadastro'
        ];        
        
        $route['logar'] = [
            'route' => '/logar',
            'controller' => 'AuthController',
            'action' => 'login'
        ];
        
        $route['sair'] = [
            'route' => '/sair',
            'controller' => 'AuthController',
            'action' => 'exit'
        ];

        $this->setRoutes($route);
    }
}