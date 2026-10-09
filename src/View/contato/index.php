<?php 
    /** @var \App\Model\Contato[] $contatos */ 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contatos</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="/public/js/app.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Contatos</h1>

        <div class="actions">
            <a href="/contatos/create" class="btn">Cadastrar Contato</a>
        </div>

        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pessoa</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($contatos as $contato): ?>
                    <tr>
                        <td><?= $contato->getId() ?></td>
                        <td><?= $contato->getPessoa()->getNome() ?></td>
                        <td><?= $contato->getTipo() === true ? 'E-mail' : 'Telefone' ?></td>
                        <td><?= $contato->getDescricao() ?></td>
                        <td>
                            <div class="table-actions">
                                <a href="/contatos/edit?id=<?= $contato->getId() ?>" class="btn">
                                    <i class="fa-solid fa-pen"></i>
                                    Editar
                                </a>

                                <form
                                    action="/contatos/delete"
                                    method="POST"
                                    class="delete-form"
                                    onsubmit="return confirmarExclusao('Deseja excluir este contato?')"
                                >
                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $contato->getId() ?>"
                                    >

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?> 
            </tbody>
        </table>

        <br>

        <a href="/pessoas" class="btn">Ver pessoas</a>
        <a href="/" class="btn btn-secondary">Início</a>
    </div>
</body>
</html>