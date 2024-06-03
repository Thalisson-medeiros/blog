<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action
{
    public function login(): void
    {
        $user = Container::getModel('users');
        $verifiedUser = $user->authenticateLogin($_POST['email'], $_POST['password']);

        $login = match($verifiedUser){
            1 => 'Campo email Inválido',
            2 => 'Senha Deve conter: letras maiúsculas , minúsculas , caracteres especiais ex: * - ! e ter no minimo 8 caracteres',
            3 => 'Usuário não encontrado',
            default => 'ok'
        };

        if($login === 'ok'){
            foreach($verifiedUser as $key => $data){
                $_SESSION['username'] = $data['name'];
                $_SESSION['id']       = $data['id_user'];
            };
            
            header('Location:/');
        }else{
            header('Location:/login?erro='.$login);
        }
    }

    public function cadastro(): void
    {
        $user = Container::getModel('users');
        $verifyRegister = $user->newUser($_POST['name'], $_POST['email'], $_POST['password']);
        
        
        $register = match($verifyRegister){
            1 => 'Campo email Inválido',
            2 => 'Senha Deve conter: letras maiúsculas , minúsculas , caracteres especiais ex: * - ! e ter no minimo 8 caracteres',
            3 => 'Campo nome não pode estar Vazio e deve ter no minimo 3 caracteres.',
            default => 'ok'
        };

        if($register === 'ok'){
            header('Location:/login');
        }else{
            header('Location:/cadastro?erro='.$register);
        }
    }

    public function comentar(): void
    {      
        $comment = Container::getModel('Comment');
        $comment->createNewComment($_POST['id_user'],$_POST['id_post'],$_POST['comment']);
        header('Location:/post?id='.$_POST['id_post']);
    }

    public function exit(): void
    {

        session_destroy();
        header('Location:/');
   
    }
}