<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../Dao/CategoriaDAO.php';
require_once '../Controller/FilmeController.php';

$categoriaDAO = new CategoriaDAO();

$categoriaFilmes = $categoriaDAO->get();

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new FilmeController(new FilmeDAO());
    $sucesso = $controller->createFilme($_POST);

    if ($sucesso) {
        $mensagem = "Filme cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar filme.";
    }
}

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Filme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="time"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .mensagem {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
            color: green;
        }
    </style>
</head>
<body>

<?php if (!empty($mensagem)): ?>
    <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
<?php endif; ?>

<h1>Criar Novo Filme</h1>

<form method="post">
    <div class="form-group">
        <label for="nome_filme">Nome do Filme</label>
        <input type="text" name="nome_filme" id="nome_filme" required>
    </div>

    <div class="form-group">
        <label for="descricao_filme">Descrição do Filme</label>
        <input type="text" name="descricao_filme" id="descricao_filme" required>
    </div>

    <div class="form-group">
        <label for="duracao_filme">Duração do Filme</label>
        <input type="time" name="duracao_filme" id="duracao_filme" required>
    </div>

    <div class="form-group">
        <label for="categoria_filme_id">Categoria</label>
        <select name="categoria_filme_id" id="categoria_filme_id" required>
            <?php foreach ($categoriaFilmes as $categoriaFilme): ?>
                <option value="<?= $categoriaFilme->get_id() ?>"
                    <?= isset($filmeSelecionadoAtualizacao) && $categoriaFilme->get_id() == $filmeSelecionadoAtualizacao->get_categoriaFilmeId() ? 'selected' : '' ?>>
                    <?= htmlspecialchars($categoriaFilme->get_nomeCategoria()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="submit" value="Enviar">
</form>
</body>
</html>
