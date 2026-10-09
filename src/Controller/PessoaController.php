<?php

namespace App\Controller;

use App\Model\Pessoa;
use App\Service\Validator;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class PessoaController {
    public function __construct(private EntityManager $entityManager) {}

    public function index() {
        $nome = $_GET['nome'] ?? '';

        $pessoas = $this->entityManager
            ->getRepository(Pessoa::class)
            ->createQueryBuilder('p')
            ->where('p.nome LIKE :nome')
            ->setParameter('nome', '%'.  $nome . '%')
            ->getQuery()
            ->getResult();

        require __DIR__ . '/../View/pessoa/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = Validator::pessoa(
                $_POST['nome'] ?? '',
                $_POST['cpf'] ?? ''
            );

            if (isset($dados['erro'])) {
                $erro = $dados['erro'];
            } else {
                $pessoa = new Pessoa();
                $pessoa->setNome($dados['nome']);
                $pessoa->setCpf($dados['cpf']);

                try {
                    $this->entityManager->persist($pessoa);
                    $this->entityManager->flush();

                    header('Location: /pessoas');
                    exit;
                } catch (UniqueConstraintViolationException $e) {
                    $erro = 'Este CPF já está cadastrado.';
                }
            }
        }

        require __DIR__ . '/../View/pessoa/create.php';
    }

    public function edit() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            http_response_code(400);
            echo 'ID inválido.';
            return;
        }

        $pessoa = $this->entityManager
            ->getRepository(Pessoa::class)
            ->find($id);

        if (!$pessoa) {
            http_response_code(404);
            echo 'Pessoa não encontrada.';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = Validator::pessoa(
                $_POST['nome'] ?? '',
                $_POST['cpf'] ?? ''
            );

            if (isset($dados['erro'])) {
                $erro = $dados['erro'];
            } else {
                $pessoa->setNome($dados['nome']);
                $pessoa->setCpf($dados['cpf']);

                try {
                    $this->entityManager->flush();

                    header('Location: /pessoas');
                    exit;
                } catch (UniqueConstraintViolationException $e) {
                    $erro = 'Este CPF já está cadastrado.';
                }
            }
        }

        require __DIR__ . '/../View/pessoa/edit.php';
    }

    public function delete() {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            http_response_code(400);
            echo 'ID inválido.';
            return;
        }

        $pessoa = $this->entityManager
            ->getRepository(Pessoa::class)
            ->find($id);

        if (!$pessoa) {
            http_response_code(404);
            echo 'Pessoa não encontrada.';
            return;
        }

        $this->entityManager->remove($pessoa);
        $this->entityManager->flush();

        header('Location: /pessoas');
        exit;
    }
}