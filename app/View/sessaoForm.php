<?php
require_once '../Dao/SessaoDAO.php';
require_once '../Dao/FilmeDAO.php';
require_once '../Dao/SalaDAO.php';

$id = $_GET['id'] ?? null;

$sessaoDAO = new SessaoDAO();
$filmeDAO = new FilmeDAO();
$salaDAO = new SalaDAO();

$filmes = $filmeDAO->get();
$salas = $salaDAO->get();

$sessao = null;
if ($id) {
    $sessao = $sessaoDAO->getById($id);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? 'Editar' : 'Nova' ?> Sessão</title>
</head>
<body>
    <h1><?= $id ? 'Editar' : 'Cadastrar' ?> Sessão</h1>

    <form method="POST" action="../Controller/SessaoController.php">
        <?php if ($id): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <?php endif; ?>

        <label for="filme_id">Filme:</label>
        <select name="filme_id" id="filme_id" required>
            <option value="">Selecione um filme</option>
            <?php foreach ($filmes as $filme): ?>
                <option value="<?= $filme['id'] ?>" <?= $sessao && $sessao['filme_id'] == $filme['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($filme['titulo']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="sala_id">Sala:</label>
        <select name="sala_id" id="sala_id" required>
            <option value="">Selecione uma sala</option>
            <?php foreach ($salas as $sala): ?>
                <option value="<?= $sala['id'] ?>" <?= $sessao && $sessao['sala_id'] == $sala['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($sala['nome_sala']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="horario">Horário:</label>
        <input type="time" name="horario" id="horario" required value="<?= $sessao['horario'] ?? '' ?>"><br>

        <button type="submit" name="acao" value="<?= $id ? 'atualizar' : 'cadastrar' ?>">
            <?= $id ? 'Atualizar' : 'Cadastrar' ?>
        </button>
    </form>
</body>
</html>
