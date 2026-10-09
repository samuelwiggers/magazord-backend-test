
<?php
    /** @var \App\Model\Contato $contato */
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Contato</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Visualizar Contato</h1>

        <form>
            <label for="pessoa">Pessoa:</label>
            <input
                type="text"
                id="pessoa"
                value="<?= $contato->getPessoa()->getNome() ?>"
                readonly
            >

            <label for="tipo">Tipo:</label>
            <input
                type="text"
                id="tipo"
                value="<?= $contato->getTipo() ? 'E-mail' : 'Telefone' ?>"
                readonly
            >

            <label for="descricao">Descrição:</label>
            <input
                type="text"
                id="descricao"
                value="<?= $contato->getDescricao() ?>"
                readonly
            >

            <div class="form-actions">
                <a href="/contatos" class="btn">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</body>
</html>
