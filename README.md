# Desafio Promobit (Teste Prático)
## Como rodar?
Utilize o repositório o meu repositório [docker](https://github.com/dancarvalhodev/docker) na branch master-mysql (essa branch possui **apenas** o container do MySQL, a branch master padrão possui o container postgresql também, **apesar de funcionar em ambas, recomendo fortemente utilizar a branch master-mysql**).

Após clonar o [docker](https://github.com/dancarvalhodev/docker), clone este repositório dentro da pasta src, está é a pasta raiz que o container do apache irá ver (está linkada diretamente no `/var/www/html`).

Na raiz da pasta do docker, rode o seguinte comando para subir o ambiente: `docker-compose up -d`.

Com tudo rodando, entre no container do apache utilizando o comando `docker exec -it apache /bin/bash`.

Acesse a pasta do projeto com `cd Desafio-Promobit`.

Digite `chmod +x configurar.sh` e finalmente `./configurar.sh`, este script sera responsável por configurar o restante do ambiente.

Por fim não esqueça de configurar o arquivo de host do seu sistema operacional. Basicamente nesse arquivo você deve adicionar o IP do Docker seguido da URL de test do projeto `http://promobit.test`.


---
## SQL de extração de relatório de relevancia de produtos
**Em Contrução**