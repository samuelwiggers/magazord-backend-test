<?php /** @var \App\Model\Pessoa[] $pessoas */ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pessoas</title>
</head>
<body>
    <h1>Pessoas</h1>

    <a href="/pessoas/create">Cadastrar pessoa</a>

    <br><br>

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
                            <a href="/pessoas/edit?id=<?= $pessoa->getId() ?>">
                                Editar
                            </a>

                            |

                            <a 
                                href="/pessoas/delete?id=<?= $pessoa->getId() ?>"
                                onclick="return confirm('Deseja realmente excluir esta pessoa?')"
                            >
                                Excluir
                            </a>
                        </td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>