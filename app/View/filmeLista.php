<?php
require_once '../Controller/FilmeController.php';
require_once '../Dao/FilmeDAO.php';
require_once '../Model/Filme.php';

$filmeDAO = new FilmeDAO();
$filme = new Filme();
$controller = new FilmeController($filmeDAO, $filme);

$filmes = $controller->indexFilme();
?>
