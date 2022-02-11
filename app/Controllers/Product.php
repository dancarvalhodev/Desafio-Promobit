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

    public function editForm($param = '')
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            if(isset($param) && ($param != ''))
            {
                $model = new ProductModel();
                $model_2 = new ProductTagModel();
                $model_3 = new TagModel();
    
                $data = $model->where(['id' => $param])->find();
    
                foreach($data as $produto)
                {
                    $data_2 = $model_2->asArray()->where(['product_id' => $produto['id']])->find();    
                }

                foreach($data_2 as $key => $tag)
                {
                    $data_3 = $model_3->asArray()->where(['id' => $tag['tag_id']])->find();


                    if(!empty($data_3))
                    {
                        $data[0]['tag'][$key] = $data_3[0]['name'];
                    }
                }

                echo view('Templates/beginning');
                echo view('Product/edit', ['data' => $data]);
                echo view('Templates/ending');
            }
            else
            {
                $_SESSION['msg'] = 'Produto Inválido';
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
                            $data = $model_2->asArray()->where(['name' =>  $tag])->find(); 
 
                            if(!empty($data))
                            {
                                $model_3->save([
                                    'product_id' => $last_id_product,
                                    'tag_id' => $data[0]['id'],
                                ]);
                            }
                            else
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

    public function update()
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            $model_product = new ProductModel();
            $model_tag = new TagModel();
            $model_product_tag = new ProductTagModel();

            $builder_product_tag = $this->db->table('product_tag');
            $builder_tag = $this->db->table('tag');

            $tags = [];

            try
            {
                if(($this->request->getPost('name') == '') || empty($this->request->getPost('tag')))
                {
                    $_SESSION['msg'] = 'Os Dados enviados não estão corretos';
                    return redirect()->to('/');
                }
                else
                {
                    $model_product->save([
                        'id' => $this->request->getPost('id'),
                        'name' => $this->request->getPost('name'),
                    ]);

                    foreach($this->request->getPost('tag') as $key => $tag)
                    {
                        try
                        {
                            $tags[$key] = $tag;
                            $data = $model_tag->asArray()->where(['name' =>  $tag])->find();
                            
                            if(isset($data[0]))
                            {
                                $data_raw = [
                                    'name' => $tag,
                                ];
                                
                                $builder_tag->where('id', $data[0]['id']);
                                $builder_tag->update($data_raw);

                            }
                            else
                            {
                                $data_raw = [
                                    'name' => $tag,
                                ];
                                
                                $builder_tag->insert($data_raw);
                            }
                        }
                        catch(Exception $e)
                        {
                            $_SESSION['msg'] = $e->getMessage();
                            return redirect()->to('/listProducts');
                        }
                    }

                    $id_produto = $model_product->asArray()->where(['name' =>  $this->request->getPost('name')])->find()[0]['id'];

                    foreach($tags as $tag_name)
                    {
                        $id_tag = $builder_tag->getWhere(['name' => $tag_name])->getResultArray()[0]['id'];
                        $return_product_tags = $model_product_tag->where(['tag_id' => $id_tag])->find();

                        if(empty($return_product_tags))
                        {
                            $model_product_tag->save([
                                'product_id' => $id_produto,
                                'tag_id' => (int)$id_tag,
                            ]);    
                        }
                        else
                        {
                            continue;
                        }
                    }

                    $_SESSION['msg'] = 'Editado com Sucesso';
                    return redirect()->to('/listProducts');
                }
            }
            catch(Exception $e)
            {
                $_SESSION['msg'] = $e->getMessage();
                return redirect()->to('/listProducts');
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

            $data = $model->findAll();

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

    public function show($param = '')
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            if(isset($param) && ($param != ''))
            {
                $model = new ProductModel();
                $model_2 = new ProductTagModel();
                $model_3 = new TagModel();
    
                $data = $model->where(['id' => $param])->find();
    
                foreach($data as $produto)
                {
                    $data_2 = $model_2->asArray()->where(['product_id' => $produto['id']])->find();    
                }

                foreach($data_2 as $key => $tag)
                {
                    $data_3 = $model_3->asArray()->where(['id' => $tag['tag_id']])->find();


                    if(!empty($data_3))
                    {
                        $data[0]['tag'][$key] = $data_3[0]['name'];
                    }
                }

                echo view('Templates/beginning');
                echo view('Product/show', ['data' => $data]);
                echo view('Templates/ending');
            }
            else
            {
                $_SESSION['msg'] = 'Produto Inválido';
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

    public function delete($param = '')
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            if(isset($param) && ($param != ''))
            {
                $builder = $this->db->table('product');
                $builder->where(['id' => $param]);
                $builder->delete();

                $_SESSION['msg'] = 'Produto Deletado com Sucesso';
                return redirect()->to('/home');
            }
            else
            {
                $_SESSION['msg'] = 'Produto Inválido';
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
}
