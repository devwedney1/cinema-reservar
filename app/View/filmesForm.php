<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../Controller/FilmeController.php';
require_once '../Dao/FilmeDAO.php';
require_once '../Dao/CategoriaDAO.php';

$filmeDAO = new FilmeDAO();
$filme = new FilmeController($filmeDAO);
$categoriaDAO = new CategoriaDAO();

$filmes = $filme->indexFilme();
$categoriaFilmes = $categoriaDAO->get();

$filmeSelecionadoAtualizacao = null;

if (isset($_GET['id']) && isset($_GET['categoria_id'])) {
    $idFilme = $_GET['id'];
    $idCategoriaFilme = $_GET['categoria_id'];
    $filmeSelecionadoAtualizacao = $filmeDAO->first($idFilme, $idCategoriaFilme);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Atualização do Filme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 30px auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            background: #fff;
            padding: 15px 20px;
            border-radius: 6px;
            box-shadow: 0 0 4px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], [type="time"], select {
            width: 100%;
            padding: 8px 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            margin-top: 25px;
            padding: 10px 18px;
            background-color: #2c7be5;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #4adb1a;
        }
        p {
            text-align: center;
            color: #a00;
            font-weight: bold;
        }
    </style>
</head>
<body>
<h1>Atualização do Filme</h1>

<?php if ($filmeSelecionadoAtualizacao): ?>
    <form method="post" action="filmesForm.php">
        <input type="hidden" name="id" value="<?= $filmeSelecionadoAtualizacao->getId() ?>"/>

        <label>Nome do Filme</label>
        <input type="text" name="nomeFilme" value="<?= htmlspecialchars($filmeSelecionadoAtualizacao->getNomeFilme()) ?>"/>

        <label>Descrição</label>
        <input type="text" name="descricaoFilme" value="<?= htmlspecialchars($filmeSelecionadoAtualizacao->getDescricaoFilme()) ?>"/>

        <label>Duração</label>
        <input type="time" name="duracaoFilme" value="<?= htmlspecialchars($filmeSelecionadoAtualizacao->getDuracaoFilme()) ?>"/>

        <label>Categoria</label>
        <select name="categoriaFilmeId">
            <?php foreach ($categoriaFilmes as $categoriaFilme): ?>
                <option value="<?= $categoriaFilme->getId() ?>"
                    <?= $categoriaFilme->getId() == $filmeSelecionadoAtualizacao->getCategoriaFilmeId() ? 'selected' : '' ?>>
                    <?= htmlspecialchars($categoriaFilme->getNomeCategoria()) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Salvar Atualização</button>
    </form>
<?php else: ?>
    <p>Filme não encontrado.</p>
<?php endif; ?>
</body>
</html>
