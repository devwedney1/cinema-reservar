<?php
require_once '../DAO/SalaDAO.php';
require_once '../Model/Sala.php';

$salaDAO = new SalaDAO();
$modoEdicao = false;
$sala = new Sala();

// Se estiver editando, buscar dados da sala
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $todasSalas = $salaDAO->get();
    foreach ($todasSalas as $item) {
        if ($item['id'] == $id) {
            $sala->set_id($item['id']);
            $sala->set_nome_sala($item['nome_sala']);
            $modoEdicao = true;
            break;
        }
    }
}

// Se formulário for enviado
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'];
    $sala->set_id($_POST['id'] ?? 0);
    $sala->set_nome_sala($_POST['nome_sala']);

    switch ($acao) {
        case 'criar':
            $resposta = $salaDAO->create($sala);
            $mensagem = $resposta['message'];
            break;
        case 'atualizar':
            $resposta = $salaDAO->update($sala);
            $mensagem = $resposta['message'];
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $modoEdicao ? 'Editar Sala' : 'Criar Sala' ?></title>
</head>
<body>
    <h1><?= $modoEdicao ? 'Editar Sala' : 'Criar Nova Sala' ?></h1>

    <?php if (!empty($mensagem)): ?>
        <p><strong><?= htmlspecialchars($mensagem) ?></strong></p>
    <?php endif; ?>

    <form method="post">
        <?php if ($modoEdicao): ?>
            <input type="hidden" name="acao" value="atualizar">
            <input type="hidden" name="id" value="<?= $sala->get_id() ?>">
        <?php else: ?>
            <input type="hidden" name="acao" value="criar">
        <?php endif; ?>

        <label for="nome_sala">Nome da Sala:</label>
        <input type="text" name="nome_sala" id="nome_sala" required
               value="<?= htmlspecialchars($sala->get_nome_sala()) ?>">

        <br><br>
        <button type="submit"><?= $modoEdicao ? 'Atualizar' : 'Criar' ?></button>
    </form>

    <br>
    <a href="view-salas.php">Voltar para lista de salas</a>
</body>
</html>
