# faberdata teste 


Teste realizando utilizando as tecnologias PHP e Angular JS

Basicamente é um cadastro de tarefas simples com data limite.

Cadastro edição e exclusao de dados.

Para iniciar o projeto é necessario docker.

#

* Clonar repositorio 

```
git@github.com:luizsonego/faberdata.git
```

* Iniciar docker
```
docker-compose up -d
```

* Navegar para pasta "frontend"

```
cd frontend
```

* Iniciar front-end Angular

```
ng serve --open
```


#

O docker esta instalando tudo necessario para rodar um ambiente com ```PHP 7.4``` e ```Apache``` e banco de dados ``` mysql:5.7```.

O docker esta criando tambem  uma tabela com nome de ```tasks``` que esta na pasta dump.


# 

As rotas api sao as seguintes:

* Criar um registro
```
POST: localhost:8000/api/task/create.php
{
	"title":"Titulo da task",
	"description": "Descrição da task",
	"status": "Ativo",
	"timelimit": "21-06-2022"
}
```

* Buscar todos os registros
```
GET: localhost:8000/api/task/index.php
```

* Buscar um unico registro por id
```
GET: localhost:8000/api/task/view.php?id=[id]
```

* Atualizar um registro por id
```
PUT: localhost:8000/api/task/update.php
{
	"id": 4,
	"title":"Titulo da task alterada",
	"description": "Descrição da task alterada",
	"status": "Finalizada",
}
```

* Deletar um registo por id
```
DELETE: localhost:8000/api/task/delete.php
{
	"id": 1
}
```