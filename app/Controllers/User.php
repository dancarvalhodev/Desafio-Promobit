<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        session_start();
    }

    public function loginForm()
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            echo view('Templates/beginning');
            echo view('Logged/index');
            echo view('Templates/ending');
        }
        else
        {
            echo view('Templates/beginning');
            echo view('login');
            echo view('Templates/ending');
        }
    }

    public function registerForm()
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            echo view('Templates/beginning');
            echo view('Logged/index');
            echo view('Templates/ending');
        }
        else
        {
            echo view('Templates/beginning');
            echo view('register');
            echo view('Templates/ending');
        }
    }

    public function create()
    {
        $model = new UserModel();
        
        try{
            if(
                (($this->request->getPost('name')) != null) &&
                (($this->request->getPost('email')) != null) &&
                (($this->request->getPost('password')) != null) &&
                (($this->request->getPost('password_check')) != null))
            {
                if(($this->request->getPost('password') === $this->request->getPost('password_check')))
                {
                    $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);


                    $model->save([
                        'name' => $this->request->getPost('name'),
                        'email' => $this->request->getPost('email'),
                        'password' =>  $hash,
                    ]);
    
                    $_SESSION['msg'] = 'Registrado com Sucesso';
                    return redirect()->to('/');
                    
                }
                else
                {
                    $_SESSION['msg'] = 'As senhas não são iguais';
                    return redirect()->to('/register');
                }
            }
        }        
        catch(\Exception $e){
            $_SESSION['msg'] = $e->getMessage();
            return redirect()->to('/register');
        }
    }

    public function read()
    {
        $model = new UserModel();
        try{
            if(
                (($this->request->getPost('email')) != null) &&
                (($this->request->getPost('password')) != null))
            {
                $result = $model->where('email', $this->request->getPost('email'))->findAll();

                if($result){
                    if(password_verify($this->request->getPost('password'), $result[0]['password'])){
                        session_regenerate_id();

                        $_SESSION['loggedin'] = TRUE;
                        $_SESSION['name'] = $result[0]['name'];
                        $_SESSION['email'] = $result[0]['email'];
            
                        return redirect()->to('/home');

                    }
                    else{
                        session_destroy();
        
                        $_SESSION['msg'] = 'VOCÊ NÃO TEM PERMISSÃO PARA ACESSAR ESSE CONTEÚDO';
                        return redirect()->to('/');
                    }
                }
                else{   
                    $_SESSION['msg'] = 'Dados de email e/ou senha não estão corretos';
                    return redirect()->to('/');
                }

            }
        }
        catch(\Exception $e){
            $_SESSION['msg'] = $e->getMessage();
            return redirect()->to('/');
        }
    }

    public function index(){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            echo view('Templates/beginning');
            echo view('Logged/index');
            echo view('Templates/ending');
        }
    }
}
