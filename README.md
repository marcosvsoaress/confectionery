## Sobre

O projeto foi desenvolvido em laravel e consiste em um API que possibilita realizar um CRUD para o gerenciamento de
cadastros de bolos, juntamente com uma lista de e-mails de clientes que estão interessados em adquiri-los.

Os e-mails são cadastrados tendo um bolo como referência (1:N) e são disparados sempre que esse
item (bolo) estiver com quantidade de produtos em estoque.

## Endpoints
Os endpoints para utilização da API estão disponíveis na raiz do repositório (Confectionery.postman_collection). 
Trata-se de um arquivo que pode ser importado para o postman.

## Envio de e-mails
Os e-mails são processados e enviados por meio de `queues`, e para que estejam disponíves nessa queue foi criado um 
`command` que irá realizar tarefa. Ao executar esse comando uma busca pelos produtos com quantidades em estoque 
irá ser feita no banco de dados, dessa forma será possível obter a lista de todos os e-mails interessados. 
Este `command` pode ser executado pela seguinte sentença:
`php artisan interest-list:send`.

E para que a queue seja processada e o envio dos e-mails seja iniciado, é necessário que
o processo responsável por consumir a fila seja iniciado pelo seguinte comando:
`php artisan queue:work`.

## Ambiente

O ambiente para executar o projeto pode ser feito utilizando o docker, que já está incluso
no projeto.

As variveis de ambiente necessárias para o projeto estão disponíveis no arquivo `env.exemple`.
