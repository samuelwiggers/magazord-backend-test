<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . '/../vendor/autoload.php';

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/../src/Model'],
    isDevMode: true,
);

$connection = DriverManager::getConnection([
    'dbname' => 'contatos',
    'user' => 'postgres',
    'password' => 'postgres',
    'host' => 'db',
    'port' => '3306',
    'driver' => 'pdo_mysql',
], $config);

$entityManager = new EntityManager(
    $connection,
    $config
);

return $entityManager;