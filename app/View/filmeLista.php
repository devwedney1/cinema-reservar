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

        .cadastro-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f9f9f9;
            padding: 15px 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            max-width: 600px;
            margin-bottom: 20px;
        }

        .cadastro-texto {
            font-size: 16px;
            color: #333;
            margin-right: 20px;
        }

        .buttonCadastra {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
        }

        .buttonCadastra a {
            color: white;
            text-decoration: none;
        }

        .buttonCadastra:hover {
            background-color: #218838;
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

<div class="cadastro-container">
    <div class="cadastro-texto">
        Cadastre novos filmes para o catálogo do cinema.
    </div>
    <button class="buttonCadastra">
        <a href="./filmeFormCreate.php">Cadastrar Filme</a>
    </button>
</div>

<h1>Lista de Filmes</h1>


<?php if (count($filmes) > 0): ?>
    <ul>
        <?php foreach ($filmes as $filme): ?>
            <li>
                <p><strong>ID:</strong> <?= $filme->get_id() ?></p>
                <p><strong>Nome:</strong> <?= htmlspecialchars($filme->get_nomeFilme()) ?></p>
                <p><strong>Descrição:</strong> <?= htmlspecialchars($filme->get_descricaoFilme()) ?></p>
                <p><strong>Duração:</strong> <?= htmlspecialchars($filme->get_duracaoFilme()) ?></p>
                <p><strong>Categoria:</strong> <?= htmlspecialchars($filme->get_categoriaFilme()->get_nomeCategoria()) ?></p>

                <hr>
                <button class="buttonUpdate">
                    <a href="../View/filmesForm.php?id=<?= $filme->get_id() ?>&categoria_id=<?= $filme->get_categoriaFilmeId()->get_id() ?>">Atualizar Filme</a>
                </button>
                <button class="buttonDelete">
                    <a href="../Controller/FilmeController.php?id=<?= $filme->get_id() ?>&categoria_id=<?= $filme->get_categoriaFilmeId()->get_id() ?>">Excluir Filme</a>
                </button>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Nenhum filme encontrado.</p>
<?php endif; ?>

</body>
</html>
