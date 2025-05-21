<?php
require_once '../../autoload.php';

require_once '../Controller/SalaController.php'
require_once '../Dao/SalaDAO.php'

$salaDAO = new SalaDAO();
$salas = $salaDAO->listar();
?>

<h2>Salas Cadastradas</h2>
<table border="1" cellpadding="10">
  <tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Capacidade</th>
    <th>Ações</th>
  </tr>
  <?php foreach ($salas as $sala): ?>
    <tr>
      <td><?= $sala['id'] ?></td>
      <td><?= htmlspecialchars($sala['nome']) ?></td>
      <td><?= $sala['capacidade'] ?></td>
      <td>
        <a href="salaForm.php?id=<?= $sala['id'] ?>">Editar</a>
        <a href="../../app/Controller/SalaController.php?acao=excluir&id=<?= $sala['id'] ?>" onclick="return confirm('Deseja excluir esta sala?')">Excluir</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
<br>
<a href="salaForm.php">Nova Sala</a>
