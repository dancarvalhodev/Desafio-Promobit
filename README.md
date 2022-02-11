# Desafio Promobit (Teste Prático)
## Como rodar?
Utilize o meu repositório [docker lamp](https://github.com/dancarvalhodev/docker) na branch master-mysql (esta branch possui **apenas** o container do MySQL, a branch master padrão possui o container postgresql também, **apesar de funcionar em ambas, recomendo fortemente utilizar a branch master-mysql**).

Após clonar o [docker lamp](https://github.com/dancarvalhodev/docker), o atual repositório dentro da pasta src, esta é a pasta raiz que o container do apache irá ver (está linkada diretamente no `/var/www/html`).

Na raiz da pasta do docker, rode o seguinte comando para subir o ambiente: `docker-compose up -d`.

Com tudo rodando, entre no container do apache utilizando o comando `docker exec -it apache /bin/bash`.

Acesse a pasta do projeto com `cd Desafio-Promobit`.

Digite `chmod +x configurar.sh` e finalmente `./configurar.sh`, este script sera responsável por configurar o restante do ambiente.

Por fim não esqueça de configurar o arquivo de host do seu sistema operacional. Basicamente nesse arquivo você deve adicionar o IP do Docker seguido da URL de test do projeto `http://promobit.test`.


---
## SQL de extração de relatório de relevancia de produtos
**Em Construção**

O código abaixo é a função de geração do relatório, como foi utilizado diversas funções do Forge Database e Query Builder pois foi utilizado o CodeIgniter como Framework, irei explicar os trechos onde são feitas as consultas e porque foi feito dessa forma.

```
    public function report()
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        {
            $model_tag = new TagModel();
            $model_product = new ProductModel();
            $model_product_tag = new ProductTagModel();
            
            $builder_product = $model_product->builder();
            $builder_tag = $model_tag->builder();
            $builder_product_tag = $model_product_tag->builder();

            $products_list = $builder_product->get()->getResultArray();

            foreach($products_list as $key => $produto)
            {
                $relationship = $builder_product_tag->getWhere(['product_id' => $produto['id']])->getResultArray();
                
                foreach($relationship as $key_2 => $relation)
                {
                    $tag_name = $builder_tag->getWhere(['id' => $relation['tag_id']])->getResultArray();
                    $products_list[$key]['tag'][$key_2] = $tag_name[0]['name'];
                }        
            }

            echo view('Templates/beginning');
            echo view('Product/report', ['data' => $products_list]);
            echo view('Templates/ending');
        }
        else
        {
            echo view('Templates/beginning');
            echo view('login');
            echo view('Templates/ending');
        }
    }
```