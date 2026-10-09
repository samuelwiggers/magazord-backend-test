<?php 
    /** @var \App\Model\Pessoa[] $pessoas */
    /** @var string $nome */ 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pessoas</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="/public/js/app.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Pessoas</h1>

        <div class="toolbar">
            <form method="GET" action="/pessoas" class="search-form">
                <input 
                    type="text"
                    name="nome"
                    placeholder="Pesquisar por nome"
                    value="<?= $nome ?>"
                >

                <button type="submit" class="btn">Pesquisar</button>
                <a href="/pessoas" class="btn btn-secondary">Limpar</a>
            </form>

            <button type="submit" class="btn" onclick="window.location.href='/pessoas/create'">Cadastrar pessoa</button>
        </div>


        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>CPF</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach ($pessoas as $pessoa): ?>
                        <tr>
                            <td><?= $pessoa->getId() ?></td>
                            <td><?= $pessoa->getNome() ?></td>
                            <td><?= $pessoa->getCpf() ?></td>
                            <td>
                                <div class="table-actions">
                                    <a href="/pessoas/edit?id=<?= $pessoa->getId() ?>" class="btn">
                                        <i class="fa-solid fa-pen"></i>
                                        Editar
                                    </a>

                                    <form
                                        action="/pessoas/delete"
                                        method="POST"
                                        class="delete-form"
                                        onsubmit="return confirmarExclusao('Deseja excluir esta pessoa e seus contatos?')"
                                    >
                                        <input type="hidden" name="id" value="<?= $pessoa->getId() ?>">

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                            Excluir
                                        </button>

                                        <a href="/pessoas/show?id=<?= $pessoa->getId() ?>" class="btn">
                                            <i class="fa-solid fa-eye"></i>
                                            Visualizar
                                        </a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <br>
        
        <a href="/contatos" class="btn">Ver contatos</a>
        <a href="/" class="btn">Início</a>
    </div>
</body>
</html>