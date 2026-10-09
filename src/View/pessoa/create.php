<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Pessoa</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Pessoa</h1>

        <?php if (!empty($erro)): ?>
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= $erro ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/pessoas/create">
            <label for="nome">Nome:</label>
            <input 
                type="text"
                id="nome"
                name="nome"
                required
            >

            <label for="cpf">CPF:</label>
            <input 
                type="text" 
                id="cpf"
                name="cpf"
                maxlength="11"
                required
            >

            <div class="form-actions">
                <button type="submit" class="btn">Cadastrar</button>

                <button type="button" class="btn" onclick="window.location.href='/pessoas'">Voltar</button>
            </div>
        </form>

    </div>
</body>
</html>