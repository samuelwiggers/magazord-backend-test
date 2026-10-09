<?php
    /** @var \App\Model\Contato $contato */
    /** @var \App\Model\Pessoa[] $pessoas */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Contato</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Contato</h1>

        <?php if (!empty($erro)): ?>
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= $erro ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/contatos/edit?id=<?= $contato->getId() ?>">
            <label for="idPessoa">Pessoa:</label>
            <select id="idPessoa" name="idPessoa" required>
                <?php foreach ($pessoas as $pessoa): ?>
                    <option 
                        value="<?= $pessoa->getId() ?>"
                        <?= $pessoa->getId() === $contato->getPessoa()->getId() ? 'selected' : '' ?>
                    >
                        <?= $pessoa->getNome() ?>   
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="0" <?= $contato->getTipo() ? 'selected' : '' ?>>
                    Telefone
                </option>
                <option value="1" <?= $contato->getTipo() ? 'selected' : '' ?>>
                    E-mail
                </option>
            </select>

            <label for="descricao">Descrição:</label>
            <input
                type="text" 
                id="descricao" 
                name="descricao"
                value="<?= $contato->getDescricao() ?>" 
                required
            >
            
            <div class="form-actions">
                <button type="submit" class="btn">Salvar</button>
    
                <a href="/contatos" class="btn">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>