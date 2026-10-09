<?php

namespace App\Controller;

use App\Model\Contato;
use App\Model\Pessoa;
use App\Service\Validator;
use Doctrine\ORM\EntityManager;

class ContatoController {
    public function __construct(private EntityManager $entityManager) {}

    public function index() {
        $contatos = $this->entityManager
            ->getRepository(Contato::class)
            ->findAll();

        require __DIR__ . '/../View/contato/index.php';
    }

    public function show() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $contato = $id
            ? $this->entityManager->getRepository(Contato::class)->find($id)
            : null;

        if (!$contato) {
            http_response_code(404);
            echo 'Contato não encontrado.';
            return;
        }

        require __DIR__ . '/../View/contato/show.php';
    }

    public function create() {
        $pessoas = $this->entityManager
            ->getRepository(Pessoa::class)
            ->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = Validator::contato(
                $_POST['tipo'] ?? '',
                $_POST['descricao'] ?? ''
            );

            if (isset($dados['erro'])) {
                $erro = $dados['erro'];
            } else {
                $idPessoa = filter_var(
                    $_POST['idPessoa'] ?? null,
                    FILTER_VALIDATE_INT
                );

                $pessoa = $idPessoa
                    ? $this->entityManager
                        ->getRepository(Pessoa::class)
                        ->find($idPessoa)
                    : null;

                if (!$pessoa) {
                    $erro = 'Selecione uma pessoa válida.';
                } else {
                    $contato = new Contato();

                    $contato->setTipo($dados['tipo']);
                    $contato->setDescricao($dados['descricao']);
                    $contato->setPessoa($pessoa);

                    $this->entityManager->persist($contato);
                    $this->entityManager->flush();

                    header('Location: /contatos');
                    exit;
                }
            }
        }

        require __DIR__ . '/../View/contato/create.php';
    }

    public function edit() {
        $id = filter_input(INPUT_GET,  'id', FILTER_VALIDATE_INT);

        if (!$id) {
            http_response_code(400);
            echo 'ID inválido.';
            return;
        }

        $contato = $this->entityManager
            ->getRepository(Contato::class)
            ->find($id);

        if (!$contato) {
            http_response_code(404);
            echo 'Contato não encontrado.';
            return;
        }

        $pessoas = $this->entityManager
            ->getRepository(Pessoa::class)
            ->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = Validator::contato(
                $_POST['tipo'] ?? '',
                $_POST['descricao'] ?? ''
            );

            if (isset($dados['erro'])) {
                $erro = $dados['erro'];
            } else {
                $idPessoa = filter_var($_POST['idPessoa'] ?? null, FILTER_VALIDATE_INT);

                $pessoa = $idPessoa
                    ? $this->entityManager
                        ->getRepository(Pessoa::class)
                        ->find($idPessoa)
                    : null;

                if (!$pessoa) {
                    $erro = 'Selecione uma pessoa válida.';
                } else {
                    $contato->setTipo($dados['tipo']);
                    $contato->setDescricao($dados['descricao']);
                    $contato->setPessoa($pessoa);

                    $this->entityManager->flush();

                    header('Location: /contatos');
                    exit;
                }
            }
        }

        require __DIR__ . '/../View/contato/edit.php';
    }

    public function delete() {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            http_response_code(400);
            echo 'ID inválido.';
            return;
        }

        $contato = $this->entityManager
            ->getRepository(Contato::class)
            ->find($id);

        if (!$contato) {
            http_response_code(404);
            echo 'Contato não encontrado.';
            return;
        }

        $this->entityManager->remove($contato);
        $this->entityManager->flush();

        header('Location: /contatos');
        exit;
    }
}