
<?php
    /** @var \App\Model\Pessoa $pessoa */
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Pessoa</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Visualizar Pessoa</h1>

        <form>
            <label for="nome">Nome:</label>
            <input
                type="text"
                id="nome"
                value="<?= $pessoa->getNome() ?>"
                readonly
            >

            <label for="cpf">CPF:</label>
            <input
                type="text"
                id="cpf"
                value="<?= $pessoa->getCpf() ?>"
                readonly
            >

            <div class="form-actions">
                <a href="/pessoas/edit?id=<?= $pessoa->getId() ?>" class="btn">
                    Editar
                </a>

                <a href="/pessoas" class="btn">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</body>
</html>
