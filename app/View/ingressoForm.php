<?php
require_once '../Dao/IngressoDAO.php';
require_once '../Dao/SessaoDAO.php';
require_once '../Dao/CadeiraDAO.php';
require_once '../Dao/FormaPagamentoDAO.php';

$id = $_GET['id'] ?? null;

$ingressoDAO = new IngressoDAO();
$sessaoDAO = new SessaoDAO();
$cadeiraDAO = new CadeiraDAO();
$formaPagamentoDAO = new FormaPagamentoDAO();

$sessoes = $sessaoDAO->get();
$cadeiras = $cadeiraDAO->get();
$formasPagamento = $formaPagamentoDAO->get();

$ingresso = null;
if ($id) {
    $ingresso = $ingressoDAO->getById($id);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? 'Editar' : 'Novo' ?> Ingresso</title>
</head>
<body>
    <h1><?= $id ? 'Editar' : 'Cadastrar' ?> Ingresso</h1>

    <form method="POST" action="../Controller/IngressoController.php">
        <?php if ($id): ?>
            <input type="hidden" name="id" value="<?= $id ?>">
        <?php endif; ?>

        <label for="sessao_id">Sessão:</label>
        <select name="sessao_id" required>
            <?php foreach ($sessoes as $sessao): ?>
                <option value="<?= $sessao['id'] ?>" <?= $ingresso && $ingresso['sessao_id'] == $sessao['id'] ? 'selected' : '' ?>>
                    <?= 'Sessão ' . $sessao['id'] . ' - Filme ' . $sessao['filme_id'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="cadeira_id">Cadeira:</label>
        <select name="cadeira_id" required>
            <?php foreach ($cadeiras as $cadeira): ?>
                <option value="<?= $cadeira['id'] ?>" <?= $ingresso && $ingresso['cadeira_id'] == $cadeira['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cadeira['codigo']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="forma_pagamento_id">Forma de Pagamento:</label>
        <select name="forma_pagamento_id" required>
            <?php foreach ($formasPagamento as $forma): ?>
                <option value="<?= $forma['id'] ?>" <?= $ingresso && $ingresso['forma_pagamento_id'] == $forma['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($forma['descricao']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="preco">Preço:</label>
        <input type="number" name="preco" step="0.01" required value="<?= $ingresso['preco'] ?? '' ?>"><br>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="ativo" <?= isset($ingresso['status']) && $ingresso['status'] == 'ativo' ? 'selected' : '' ?>>Ativo</option>
            <option value="cancelado" <?= isset($ingresso['status']) && $ingresso['status'] == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
        </select><br>

        <button type="submit" name="acao" value="<?= $id ? 'atualizar' : 'cadastrar' ?>">
            <?= $id ? 'Atualizar' : 'Cadastrar' ?>
        </button>
    </form>
</body>
</html>
