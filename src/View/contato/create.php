<?php /** @var \App\Model\Pessoa[] $pessoas */ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Contato</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar contato</h1>

        <form method="POST" action="/contatos/create">
            <label for="idPessoa">Pessoa:</label>
            <select id="idPessoa" name="idPessoa" required>
                <option value="">Selecione uma pessoa</option>
                <?php foreach ($pessoas as $pessoa): ?>
                    <option value="<?= $pessoa->getId() ?>">
                        <?= $pessoa->getNome() ?>
                    </option>            
                <?php endforeach; ?>
            </select>

            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="">Selecione o tipo</option>
                <option value="0">Telefone</option>
                <option value="1">E-mail</option>
            </select>

            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" required>
            
            <div class="form-actions">
                <button type="submit" class="btn">Cadastrar</button>

                <a href="/contatos" class="btn">Voltar</a>
            </div>
        </form>

    </div>
</body> 
</html>