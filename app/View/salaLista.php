<?php
require_once '../Dao/SalaDAO.php';
require_once '../Model/Sala.php';

$salaDAO = new SalaDAO();
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome_sala']) && !empty(trim($_POST['nome_sala']))) {
        $sala = new Sala();
        $sala->set_nomeSala(trim($_POST['nome_sala']));
        $resultado = $salaDAO->create($sala);
        $mensagem = $resultado['message'];
    } else {
        $mensagem = "O nome da sala é obrigatório.";
    }
}

$salas = $salaDAO->get();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Salas</title>
</head>
<body>
    <h1>Cadastro de Salas</h1>

    <?php if (!empty($mensagem)): ?>
        <p><strong><?= htmlspecialchars($mensagem) ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <label for="nome_sala">Nome da Sala:</label>
        <input type="text" id="nome_sala" name="nome_sala" required>
        <button type="submit">Cadastrar</button>
    </form>

    <h2>Salas Cadastradas</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome da Sala</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salas as $sala): ?>
                <tr>
                    <td><?= htmlspecialchars($sala['id']) ?></td>
                    <td><?= htmlspecialchars($sala['nome_sala']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
