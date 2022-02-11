<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TagModel;
use Exception;

class Tag extends BaseController
{
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
            echo view('Tag/new');
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
            $model = new TagModel();

            try{
                if(($this->request->getPost('name') == ''))
                {
                    $_SESSION['msg'] = 'O Dado enviado não esta correto';
                    return redirect()->to('/home');
                }
                else
                {
                    $model->save([
                        'name' => $this->request->getPost('name'),
                    ]);

                    $_SESSION['msg'] = 'Cadastrada com Sucesso';
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
            $model = new TagModel();
            $data = $model->findAll();

            echo view('Templates/beginning');
            echo view('Tag/list', ['data' => $data]);
            echo view('Templates/ending');
        }
        else
        {
            echo view('Templates/beginning');
            echo view('login');
            echo view('Templates/ending');
        }
    }

    public function delete($param = '')
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            if(isset($param) && ($param != ''))
            {
                $builder = $this->db->table('tag');
                $builder->where(['id' => $param]);
                $builder->delete();

                $_SESSION['msg'] = 'Tag Deletada com Sucesso';
                return redirect()->to('/listTags');
            }
            else
            {
                $_SESSION['msg'] = 'Tag Inválida';
                return redirect()->to('/listTags');
            }
        }
        else
        {
            echo view('Templates/beginning');
            echo view('login');
            echo view('Templates/ending');
        }
    }

    public function editForm($param = '')
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            if(isset($param) && ($param != ''))
            {
                $model = new TagModel();
                $data = $model->asArray()->where(['id' => $param])->find();
                
                echo view('Templates/beginning');
                echo view('Tag/edit', ['data' => $data]);
                echo view('Templates/ending');
            }
            else
            {
                $_SESSION['msg'] = 'Tag Inválida';
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

    public function update()
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            $model_tag = new TagModel();
            $builder_tag = $this->db->table('tag');

            try
            {
                if(($this->request->getPost('name') == ''))
                {
                    $_SESSION['msg'] = 'Os Dados enviados não estão corretos';
                    return redirect()->to('/');
                }
                else
                {
                    $data_raw = [
                        'name' => $this->request->getPost('name') ,
                    ];
                    
                    $builder_tag->where('id', $this->request->getPost('id'));
                    $builder_tag->update($data_raw);

                    $_SESSION['msg'] = 'Editada com Sucesso';
                    return redirect()->to('/listTags');
                }
            }
            catch(Exception $e)
            {
                $_SESSION['msg'] = $e->getMessage();
                return redirect()->to('/listTags');
            }
        
        }
        else
        {
            echo view('Templates/beginning');
            echo view('login');
            echo view('Templates/ending');
        }
    }
}
