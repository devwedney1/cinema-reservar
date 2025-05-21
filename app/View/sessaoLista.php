<?php
require_once '../Dao/SessaoDAO.php';

$sessaoDAO = new SessaoDAO();
$sessoes = $sessaoDAO->get();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Sessões</title>
</head>
<body>
    <h1>Sessões Cadastradas</h1>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Filme</th>
                <th>Sala</th>
                <th>Horário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sessoes as $sessao): ?>
                <tr>
                    <td><?= htmlspecialchars($sessao['id']) ?></td>
                    <td><?= htmlspecialchars($sessao['filme_id']) ?></td>
                    <td><?= htmlspecialchars($sessao['sala_id']) ?></td>
                    <td><?= htmlspecialchars($sessao['horario']) ?></td>
                    <td>
                        <a href="sessaoForm.php?id=<?= $sessao['id'] ?>">Editar</a> |
                        <a href="../Controller/SessaoController.php?acao=excluir&id=<?= $sessao['id'] ?>" onclick="return confirm('Excluir esta sessão?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <button onclick="location.href='sessaoForm.php'">Nova Sessão</button>
</body>
</html>
