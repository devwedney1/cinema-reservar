<?php
require_once '../Connection/DataConnection.php';
require_once '../Dao/SessaoDAO.php';
require_once '../Model/Sessao.php';
require_once '../Model/Sala.php';
require_once '../Model/Filme.php';

class SessaoController {
    public function ListarSessoes() {
        $sessaoDAO = new SessaoDAO();

        $listaDeSessoes = $sessaoDAO->get();

        print_r($listaDeSessoes);
    }

    public function ListarSessoesPorFilme() {
        $sessaoDAO = new SessaoDAO();
        if (!isset($_GET['filme_id']) || !is_numeric($_GET['filme_id'])) {
            echo "ID do filme não informado ou inválido";
            return;
        }

        $filme_id = (int)$_GET['filme_id'];

        $filme = new Filme();
        $filme->setId($filme_id);

        $resultado = $sessaoDAO->getByFilmeId($filme);

        print_r($resultado);
    }

    public function ListarSessoesPorSala() {
        $sessaoDAO = new SessaoDAO();
        if (!isset($_GET['sala_id']) || !is_numeric($_GET['sala_id'])) {
            echo "ID da sala não informado ou inválido";
            return;
        }

        $sala_id = (int)$_GET['sala_id'];

        $sala = new Sala();
        $sala->setId($sala_id);

        $resultado = $sessaoDAO->getBySalaId($sala);

        print_r($resultado);
    }

    public function CriarSessao() {
        $sessaoDAO = new SessaoDAO();
        if (!isset($_POST['filme_id']) || (!isset($_POST['sala_id']))) {
            echo "Dados incompletos para criar a sessão.";
            return;
        }
        
        // Dados POST
        $filme_id = (int)$_POST['filme_id'];
        $sala_id = (int)$_POST['sala_id'];

        $novaSessao = new Sessao();
        $novaSessao->setFilme_id($filme_id);
        $novaSessao->setSala_id($sala_id);

        $resultado = $sessaoDAO->create($novaSessao);

        print_r($resultado);
    }

    public function AtualizarSessao() {
        $sessaoDAO = new SessaoDAO();
        if (!isset($_POST['id']) || !isset($_POST['filme_id']) || !isset($_POST['sala_id'])) {
            echo "Dados incompletos para atualizar a sessão.";
            return;
        }
        
        // Dados POST
        $id = (int)$_POST['id'];
        $filme_id = (int)$_POST['filme_id'];
        $sala_id = (int)$_POST['sala_id'];

        $updateSessao = new Sessao();

        $updateSessao->setId($id);
        $updateSessao->setFilme_id($filme_id);
        $updateSessao->setSala_id($sala_id);

        $resultado = $sessaoDAO->update($updateSessao);

        print_r($resultado);
    }

    public function DeletarSessao() {
        $sessaoDAO = new SessaoDAO();

        if (!isset($_POST['id'])) {
            echo "ID da sessão não informado para a exclusão.";
            return;
        }

        // Dados POST
        $id = (int)$_POST['id'];

        $deleteSessao = new Sessao();
        $deleteSessao->setId($id);

        $resultado = $sessaoDAO->delete($deleteSessao);

        print_r($deleteSessao);
    }
}