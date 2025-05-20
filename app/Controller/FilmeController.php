<?php
require_once '../Connection/DataConnection.php';
require_once '../Dao/FilmeDAO.php';
require_once '../Model/Filme.php';

class FilmeController {
    public function ListarFilmes() {
        $filmeDAO = new FilmeDAO();
        
        $listaDeFilmes = $filmeDAO->get();

        print_r($listaDeFilmes);
    }

    public function CriarFilme() {
        $filmeDAO = new FilmeDAO();

        //Dados POST
        $nome = $_POST['nome_filme'];
        $descricao = $_POST['descricao_filme'];
        $duracao = $_POST['duracao_filme'];

        $novoFilme = new Filme();
        $novoFilme->setNomeFilme($nome);
        $novoFilme->setDescricaoFilme($descricao);
        $novoFilme->setDuracaoFilme($duracao);

        $resultado = $filmeDAO->create($novoFilme);

        print_r($resultado);
    }

    public function AtualizarFilme() {
        $filmeDAO = new FilmeDAO();

        if (!isset($_POST['id'])) {
            echo "ID do filme não informado para atualização.";
            return;
        }

        $id = $_POST['id'];
        $nome = $_POST['nome_filme'];
        $descricao = $_POST['descricao_filme'];
        $duracao = $_POST['duracao_filme'];

        $updateFilme = new Filme();
        $updateFilme->setNomeFilme($nome);
        $updateFilme->setDescricaoFilme($descricao);
        $updateFilme->setDuracaoFilme($duracao);

        $resultado = $filmeDAO->update($updateFilme);

        print_r($resultado);
    }

    public function DeletarFilme() {
        $filmeDAO = new FilmeDAO();

        if (!isset($_POST['id'])) {
            echo "ID do filme não informado.";
            return;
        }

        $id = $_POST['id'];

        $deleteFilme = new Filme();
        $deleteFilme->setId($id);

        $resultado = $filmeDAO->delete($deleteFilme);

        print_r($resultado);
    }
}