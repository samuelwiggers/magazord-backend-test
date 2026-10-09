<?php 
    /** @var \App\Model\Pessoa $pessoa */ 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Pessoa</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Pessoa</h1>

        <?php if (!empty($erro)): ?>
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= $erro ?>
            </div>
        <?php endif; ?>

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

            <div class="form-actions">
                <button type="submit" class="btn">Salvar</button>
                
                <button type="button" class="btn" onclick="window.location.href='/pessoas'">Voltar</button>
            </div>
        </form>
    </div>
</body>
</html>