<?php

require_once __DIR__ . '/../Controller/CadeiraController.php';
require_once __DIR__ . '/../Dao/CadeiraDAO.php';

$dao = new CadeiraDAO();
$cadeiras = $dao->get();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Cadeiras</title>
  <link rel="stylesheet" href="../front/css/style.css">
</head>
<body>
  <h1>Cadeiras Cadastradas</h1>

  <table border="1" cellpadding="10">
    <tr>
      <th>ID</th>
      <th>Sala</th>
      <th>Número</th>
      <th>Ações</th>
    </tr>

    <?php foreach ($cadeiras as $cadeira): ?>
      <tr>
        <td><?= htmlspecialchars($cadeira['id']) ?></td>
        <td><?= htmlspecialchars($cadeira['sala_nome']) ?></td>
        <td><?= htmlspecialchars($cadeira['numero']) ?></td>
        <td>
          <a href="cadeiraForm.php?id=<?= $cadeira['id'] ?>">Editar</a> |
          <a href="../../app/Controller/CadeiraController.php?acao=excluir&id=<?= $cadeira['id'] ?>" onclick="return confirm('Deseja excluir esta cadeira?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>

  </table>

  <br>
  <button onclick="window.location.href='cadeiraForm.php'">Nova Cadeira</button>
</body>
</html>
