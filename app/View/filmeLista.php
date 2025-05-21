<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../Controller/FilmeController.php';
require_once '../Dao/FilmeDAO.php';

$filmeDAO = new FilmeDAO();
$filmes = new FilmeController($filmeDAO);

$filmes = $filmes->indexFilme();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Filmes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 30px auto;
            padding: 0 15px;
            background-color: #f7f7f7;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #222;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: white;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        p {
            margin: 5px 0;
        }
        hr {
            border: 0;
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }
        .buttonUpdate{
            background-color: rgb(255, 106, 0);
            border: none;
            padding: 8px 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buttonDelete{
            background-color: #ff0000;
            border: none;
            padding: 8px 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            display: inline-block;
        }
    </style>
</head>
<body>

<h1>Lista de Filmes</h1>

<?php if (count($filmes) > 0): ?>
    <ul>
        <?php foreach ($filmes as $filme): ?>
            <li>
                <p><strong>ID:</strong> <?= $filme->getId() ?></p>
                <p><strong>Nome:</strong> <?= htmlspecialchars($filme->getNomeFilme()) ?></p>
                <p><strong>Descrição:</strong> <?= htmlspecialchars($filme->getDescricaoFilme()) ?></p>
                <p><strong>Duração:</strong> <?= htmlspecialchars($filme->getDuracaoFilme()) ?></p>
                <p><strong>Categoria:</strong> <?= htmlspecialchars($filme->getCategoriaFilme()) ?></p>
                <hr>
                <button class="buttonUpdate">
                    <a href="../View/filmesForm.php?id=<?= $filme->getId() ?>&categoria_id=<?= $filme->getCategoriaFilmeId() ?>">Atualizar Filme</a>
                </button>
                <button class="buttonDelete">
                    <a href="../Controller/FilmeController.php?id=<?= $filme->getId() ?>&categoria_id=<?= $filme->getCategoriaFilmeId() ?>">Excluir Filme</a>
                </button>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Nenhum filme encontrado.</p>
<?php endif; ?>

</body>
</html>
