<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Product extends BaseController
{
    public function __construct()
    {
        session_start();
    }

    public function newForm()
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            echo view('Templates/beginning');
            echo view('Product/new');
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
        var_dump($_POST);
        die();
        
        $model = new ProductModel();
        
        try{
            if(
                (($this->request->getPost('name')) != null))
            {
                $model->save([
                    'name' => $this->request->getPost('name'),
                ]);

                $_SESSION['msg'] = 'Cadastrado com Sucesso';
                return redirect()->to('/home');
            }
        }        
        catch(\Exception $e){
            $_SESSION['msg'] = $e->getMessage();
            return redirect()->to('/home');
        }
    }
}
