<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\ProductTag;
use App\Models\ProductModel;
use App\Models\ProductTagModel;
use App\Models\TagModel;
use Exception;

class Product extends BaseController
{
    private $db;

    public function __construct()
    {
        session_start();
        $this->db = \Config\Database::connect();
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
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            $model = new ProductModel();
            $model_2 = new TagModel();
            $model_3 = new ProductTagModel();

            try{
                if(($this->request->getPost('name') == '') || empty($this->request->getPost('tag')))
                {
                    $_SESSION['msg'] = 'Os Dados enviados não estão corretos';
                    return redirect()->to('/');
                }
                else
                {
                    $model->save([
                        'name' => $this->request->getPost('name'),
                    ]);
    
                    $last_id_product = $this->db->insertID();
    
                    foreach($this->request->getPost('tag') as $tag)
                    {
                        try
                        {
                            $model_2->save([
                                'name' => $tag,
                            ]);
    
                            $last_id = $this->db->insertID();
    
                            $model_3->save([
                                'product_id' => $last_id_product,
                                'tag_id' => $last_id,
                            ]);
    
                        }
                        catch(Exception $e)
                        {
                            $_SESSION['msg'] = $e->getMessage();
                            return redirect()->to('/home');
                        }
                    }
    
                    $_SESSION['msg'] = 'Cadastrado com Sucesso';
                    return redirect()->to('/home');
                }
            }        
            catch(\Exception $e)
            {
                $_SESSION['msg'] = $e->getMessage();
                return redirect()->to('/home');
            }
        }
        else
        {
            echo view('Templates/beginning');
            echo view('login');
            echo view('Templates/ending');
        }
    }

    public function read()
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            $model = new ProductModel();
            $model_2 = new ProductTagModel();

            $data = $model->findAll();

            foreach($data as $key => $produto)
            {
                $data_2 = $model_2->asArray()->where(['product_id' => $produto['id']])->find();
                
                if(!empty($data_2))
                {
                    $data[$key]['tag'] = $data_2;
                }

            }

            echo view('Templates/beginning');
            echo view('Product/list', ['data' => $data]);
            echo view('Templates/ending');
        }
        else
        {
            echo view('Templates/beginning');
            echo view('login');
            echo view('Templates/ending');
        }
    }
}
