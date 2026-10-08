<?php /** @var \App\Model\Pessoa $pessoa */ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Pessoa</title>
</head>
<body>
    <h1>Editar Pessoa</h1>

    <form method="post" action="/pessoas/edit?id=<?= $pessoa->getId() ?>">
        <div>
            <label for="nome">Nome</label>
            <input 
                type="text"
                name="nome" 
                id="nome"
                value="<?= $pessoa->getNome() ?>"
                required
            >
        </div>

        <br><br>

        <div>
            <label for="cpf">CPF:</label>

            <input
                type="text"
                id="cpf"
                name="cpf"
                value="<?= $pessoa->getCpf() ?>"
                maxlength="11"
                required
            >
        </div>

        <button type="submit">Salvar</button>
    </form>

    <br>

    <a href="/pessoas">Voltar</a>
</body>
</html>