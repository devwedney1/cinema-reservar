<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../Controller/FilmeController.php';
require_once '../Dao/FilmeDAO.php';

$filmeDAO = new FilmeDAO();
// Cria instância do DAO
$filmes = new FilmeController($filmeDAO);

// Tenta obter filmes do banco
$filmes = $filmes->indexFilme(); // ou indexFilme() se for esse o nome certo

// Exibe os dados
echo "<h1>Lista de Filmes</h1>";

if (is_array($filmes) && count($filmes) > 0) {
    echo "<ul>";

    foreach ($filmes as $filme) {
        echo "<p>ID: " . $filme->getId() . "</p>";
        echo "<p>Nome: " . $filme->getNomeFilme() . "</p>";
        echo "<p>Descrição: " . $filme->getDescricaoFilme() . "</p>";
        echo "<p>Duração: " . $filme->getDuracaoFilme() . "</p>";
        echo "<p>Categoria: " . $filme->getCategoriaFilme() . "</p>";
        echo "<hr>";
        echo "<button href='../app/view/filmesForm.php'>Atualizar Filme</button>";

    }
    echo "</ul>";
} else {
    echo "<p>Nenhum filme encontrado.</p>";
}
?>
