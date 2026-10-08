<?php

use App\Controller\PessoaController;
use App\Router\Router;

$entityManager = require_once 'config/doctrine.php';

$pessoaController = new PessoaController($entityManager);

$router = new Router();

$router->get('/pessoas', [$pessoaController, 'index']);

$router->get('/pessoas/create', [$pessoaController, 'create']); 
$router->post('/pessoas/create', [$pessoaController, 'create']); 

$router->get('/pessoas/edit', [$pessoaController, 'edit']);
$router->post('/pessoas/edit', [$pessoaController, 'edit']);

$router->get('/pessoas/delete', [$pessoaController, 'delete']);

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);