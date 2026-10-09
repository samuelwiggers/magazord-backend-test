<?php

use App\Controller\PessoaController;
use App\Controller\ContatoController;
use App\Router\Router;

$entityManager = require_once 'config/doctrine.php';

$pessoaController = new PessoaController($entityManager);
$contatoController = new ContatoController($entityManager);

$router = new Router();

$router->get('/', function () {
    require __DIR__ . '/src/View/home/index.php';
});

$router->get('/pessoas', [$pessoaController, 'index']);

$router->get('/pessoas/show', [$pessoaController, 'show']);

$router->get('/pessoas/create', [$pessoaController, 'create']); 
$router->post('/pessoas/create', [$pessoaController, 'create']); 

$router->get('/pessoas/edit', [$pessoaController, 'edit']);
$router->post('/pessoas/edit', [$pessoaController, 'edit']);

$router->post('/pessoas/delete', [$pessoaController, 'delete']);

$router->get('/contatos', [$contatoController, 'index']);

$router->get('/contatos/show', [$contatoController, 'show']);

$router->get('/contatos/create', [$contatoController, 'create']);
$router->post('/contatos/create', [$contatoController, 'create']);

$router->get('/contatos/edit', [$contatoController, 'edit']);
$router->post('/contatos/edit', [$contatoController, 'edit']);

$router->post('/contatos/delete', [$contatoController, 'delete']);

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);