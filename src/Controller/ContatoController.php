<?php

namespace App\Controller;

use App\Model\Contato;
use App\Model\Pessoa;
use Doctrine\ORM\EntityManager;

class ContatoController {
    public function __construct(private EntityManager $entityManager) {}

    public function index() {
        $contatos = $this->entityManager
            ->getRepository(Contato::class)
            ->findAll();

        require __DIR__ . '/../View/contato/index.php';
    }

    public function create() {
        $pessoas = $this->entityManager
            ->getRepository(Pessoa::class)
            ->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->validarContato();

            if ($dados === null) {
                echo 'Dados do contato inválidos.';
                return;
            }

            $pessoa = $this->entityManager
                ->getRepository(Pessoa::class)
                ->find($dados['idPessoa']);

            $contato = new Contato();

            $contato->setTipo($dados['tipo']);
            $contato->setDescricao($dados['descricao']);
            $contato->setPessoa($pessoa);

            $this->entityManager->persist($contato);
            $this->entityManager->flush();

            header('Location: /contatos');
            exit;
        }

        require __DIR__ . '/../View/contato/create.php';
    }

    public function edit() {
        $contato = $this->entityManager
            ->getRepository(Contato::class)
            ->find($_GET['id']);

        $pessoas = $this->entityManager
            ->getRepository(Pessoa::class)
            ->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->validarContato();

            if ($dados === null) {
                echo 'Dados do contato inválidos.';
                return;
            }

            $pessoa = $this->entityManager
                ->getRepository(Pessoa::class)
                ->find($dados['idPessoa']);

            $contato->setTipo($dados['tipo']);
            $contato->setDescricao($dados['descricao']);
            $contato->setPessoa($pessoa);

            $this->entityManager->flush();

            header('Location: /contatos');
            exit;
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

    private function validarContato() {
        $tipo = $_POST['tipo'] ?? null;
        $descricao = trim($_POST['descricao'] ?? '');
        $idPessoa = filter_var(
            $_POST['idPessoa'],
            FILTER_VALIDATE_INT,
        );

        if (!in_array($tipo, ['0', '1'], true) || $descricao === '' || !$idPessoa) {
            return null;
        }

        if ($tipo === '1' && !filter_var($descricao, FILTER_VALIDATE_EMAIL)) {
            return null;
        }

        if ($tipo === '0') {
            $telefone = preg_replace('/\D/', '', $descricao);

            if (!in_array(strlen($telefone), [10, 11], true)) {
                return null;
            }
            
            $descricao = $telefone;
        }

        return [
            'tipo' => $tipo,
            'descricao' => $descricao,
            'idPessoa' => $idPessoa,
        ];
    }
}