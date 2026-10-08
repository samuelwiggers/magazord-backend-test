<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Pessoa</title>
</head>
<body>
    <h1>Cadastrar Pessoa</h1>

    <form method="POST" action="/pessoas/create">
        <label for="nome">Nome:</label>
        <input 
            type="text"
            id="nome"
            name="nome"
            required
        >

        <br><br>

        <label for="cpf">CPF:</label>
        <input 
            type="text" 
            id="cpf"
            name="cpf"
            maxlength="11"
            required
        >

        <br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <br>

    <a href="/pessoas">Voltar</a>
</body>
</html>