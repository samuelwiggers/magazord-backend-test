# magazord-backend-test

Projeto desenvolvido para o teste técnico de Back-end da Magazord.

A aplicação permite cadastrar, listar, editar e excluir pessoas e seus contatos, além de realizar buscas de pessoas pelo nome.

## Tecnologias utilizadas

- PHP 8.3
- MySQL 8.0
- Doctrine ORM
- HTML, CSS e JavaScript
- Docker
- PHPUnit

O projeto foi desenvolvido utilizando o padrão MVC, sem frameworks PHP.

## Como executar

É necessário ter o Docker instalado.

Clone o repositório e acesse a pasta do projeto:

```bash
git clone URL_DO_REPOSITORIO
cd magazord-backend-test
```

Inicie os containers:

```bash
docker compose up --build -d
```

Após a inicialização, acesse:

**http://localhost:8080**

O banco de dados será criado automaticamente na primeira execução por meio do arquivo `database/init.sql`.

## Testes

Foram implementados testes unitários com PHPUnit para validar os dados de pessoas e contatos.

Para executar:

```bash
docker compose exec app ./vendor/bin/phpunit
```