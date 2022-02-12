# Desafio Promobit (Teste Prático)

## Requisitos
Docker e Docker compose instalados (a forma de instalar varia de sistema para sistema).
### Docker
[Instalação em ambiente Windows](https://docs.docker.com/desktop/windows/install/), **ative o WSL2** para ter acesso a um ambiente Docker mais proximo do Linux e Mac.
[Instalação em ambiente macOS](https://docs.docker.com/desktop/mac/install/).
[Instalação em ambiente Linux](https://docs.docker.com/engine/install/), **escolha a distribuição correta antes de instalar**.
### Docker Compose
[Documentação Oficial](https://docs.docker.com/compose/install/).

## Como rodar?
Utilize o meu repositório [docker lamp](https://github.com/dancarvalhodev/docker) na branch master-mysql (esta branch possui **apenas** o container do MySQL).

Após clonar o [docker lamp](https://github.com/dancarvalhodev/docker), clone o atual repositório dentro da pasta src.

Na raiz da pasta do docker, rode o seguinte comando para subir o ambiente: `docker-compose up -d` **este comando pode levar alguns minutos para ser concluído dependendo da velocidade da conexão com a internet**.

Com tudo rodando, entre no container do apache utilizando o comando `docker exec -it apache /bin/bash`.

Acesse a pasta do projeto com `cd Desafio-Promobit`.

Digite `chmod +x configurar.sh` e finalmente `./configurar.sh`. Este script sera responsável por algumas configurações do projeto e realizar o download das dependências.

Abra o [MySQL Workbench](https://dev.mysql.com/downloads/workbench/) e crie uma nova database com o nome de promobit. Ele já vai pegar os dados do container do MySQL automaticamente, caso não o faça, crie uma conexão com o usuário e senha como root e crie a database normalmente.

Por fim não esqueça de configurar o arquivo de host do seu sistema operacional. Basicamente nesse arquivo você deve adicionar o IP do Docker seguido da URL de test do projeto `http://promobit.test`.


---
## SQL de extração de relatório de relevancia de produtos

**O código abaixo é responsavel pela função geradora do relatório e pode ser encontrada no controller `Product.php`.**

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
Como foram utilizadas diversas funções de database do CodeIgniter, como o Forge Database e o Query Builder, irei explicar os trechos onde são feitas as consultas.

O trecho abaixo instancia, em três variáveis, os respectivos Models para serem usados posteriormente em operações de banco de dados. 
Observação: Nesse momento foi utilizado o Forge Database
```
    $model_tag = new TagModel();
    $model_product = new ProductModel();
    $model_product_tag = new ProductTagModel();
```
Abaixo também são instanciados, em três variáveis, os respectivos Models. Entretanto, dessa vez foi utilizado o Query Builder.
```
    $builder_product = $model_product->builder();
    $builder_tag = $model_tag->builder();
    $builder_product_tag = $model_product_tag->builder();
```
**O motivo da utilização de ambas formas para se relacionar com o banco de dados foi a facilidade em se fazer algumas operações e, por isso, foi intercalado ambos modos de relacionamento.**

A linha abaixo atribui a uma variável todos os dados de produtos que estão gravados na tabela Product. O comando abaixo seria equivalente ao classico `SELECT * FROM products`

`$products_list = $builder_product->get()->getResultArray();`

Em seguida é feito um loop percorrendo toda a lista de produtos para poder fazer o manuseio dos dados individuais de cada produto. 

Em seguida é atribuído os dados a variável relationship, que é responsável por fazer uma pesquisa na tabela de relação entre produtos/tags, em busca de todas as linhas onde existam dados desse produto em especifico. Isso é feito para poder pesquisar posteriormente as tags deste produto em especifico e adiciona-las no array. Este comando seria similar ao `SELECT * FROM product_tag WHERE product_id = $produto['id']`.

Após esta atribuição é feita um outro loop, dessa vez percorrendo a lista da relação. No interior desse loop é feita uma outra consulta, dessa vez na tabela de tags para pegar o nome da tag, pois tinha-se apenas a id, e assim atribuir a variável tag_name. Este comando seria similar ao `SELECT * FROM tag WHERE id = $relation['tag_id']`.

Finalmente é montado o array com os dados, juntando os dados do produto (id e nome) com as tags (que são adicionadas em outro array, dentro da chave tags, que por sua vez está localizada no array principal, o products_list).
```
    foreach($products_list as $key => $produto)
    {
        $relationship = $builder_product_tag->getWhere(['product_id' => $produto['id']])->getResultArray();
        
        foreach($relationship as $key_2 => $relation)
        {
            $tag_name = $builder_tag->getWhere(['id' => $relation['tag_id']])->getResultArray();
            $products_list[$key]['tag'][$key_2] = $tag_name[0]['name'];
        }        
    }
```
O restante da função é apenas a impressão das views.