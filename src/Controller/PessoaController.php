<?php

namespace App\Controller;

use App\Model\Pessoa;
use Doctrine\ORM\EntityManager;

class PessoaController {
    public function __construct(private EntityManager $entityManager) {}

    public function index() {
        $pessoas = $this->entityManager
            ->getRepository(Pessoa::class)
            ->findAll();

        require __DIR__ . '/../View/pessoa/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pessoa = new Pessoa();

            $pessoa->setNome($_POST['nome']);
            $pessoa->setCpf($_POST['cpf']);

            $this->entityManager->persist($pessoa);
            $this->entityManager->flush();

            header('Location: /pessoas');
            exit;
        }

        require __DIR__ . '/../View/pessoa/create.php';
    }

    public function edit() {
        $pessoa = $this->entityManager
            ->getRepository(Pessoa::class)
            ->find($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pessoa->setNome($_POST['nome']);
            $pessoa->setCpf($_POST['cpf']);

            $this->entityManager->flush();

            header('Location: /pessoas');
            exit;
        }

        require __DIR__ . '/../View/pessoa/edit.php';
    }

    public function delete() {
        $pessoa = $this->entityManager
            ->getRepository(Pessoa::class)
            ->find($_GET['id']);

        $this->entityManager->remove($pessoa);
        $this->entityManager->flush();

        header('Location: /pessoas');
        exit;
    }
}