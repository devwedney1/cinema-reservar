<?php
require_once '../Connection/DataConnection.php';
require_once '../Dao/CadeiraDAO.php';
require_once '../Model/Cadeira.php';
require_once '../Model/Sala.php';


class CadeiraController {
    public function ListarCadeiras() {
        $cadeiraDAO = new CadeiraDAO();

        $listaDeCadeiras = $cadeiraDAO->get();

        print_r($listaDeCadeiras);
    }

    public function ListarCadeirasPorSala() {
        $cadeiraDAO = new CadeiraDAO();
        if (!isset($_GET['sala_id']) || !is_numeric($_GET['sala_id'])) {
            echo "ID da sala não informado ou inválido.";
            return;
        }

        $idSala = (int)$_GET['sala_id'];

        $sala = new Sala();
        $sala->setId($idSala);

        $resultado = $cadeiraDAO->getBySala($sala);

        print_r($resultado);
        
    }

    public function CriarCadeira() {
        $cadeiraDAO = new CadeiraDAO();

        //Dados POST
        if (!isset($_POST['sala_id']) || !isset($_POST['numero_cadeira'])) {
            echo "Dados incompletos para criar a cadeira.";
            return;
        }
        $sala_id = (int)$_POST['sala_id'];
        $numero_cadeira = (int)$_POST['numero_cadeira'];
        

        $novaCadeira = new Cadeira();


        $novaCadeira->setSala_id($sala_id);
        $novaCadeira->setNumero_cadeira($numero_cadeira);

        $resultado = $cadeiraDAO->create($novaCadeira);

        print_r($resultado);
    }

    public function AtualizarCadeira() {
        $cadeiraDAO = new CadeiraDAO();

        if (!isset($_POST['id']) || !isset($_POST['sala_id']) || !isset($_POST['numero_cadeira'])) {
            echo "Dados incompletos para atualizar a cadeira.";
            return;
        }
        // Dados POST
        $id = (int)$_POST['id'];
        $sala_id = (int)$_POST['sala_id'];
        $numero_cadeira = (int)$_POST['numero_cadeira'];

        $updateCadeira = new Cadeira();

        $updateCadeira->setId($id);
        $updateCadeira->setSala_id($sala_id);
        $updateCadeira->setNumero_cadeira($numero_cadeira);

        $resultado = $cadeiraDAO->update($updateCadeira);

        print_r($resultado);
    }

    public function DeletarCadeira() {
        $cadeiraDAO = new CadeiraDAO();

        if (!isset($_POST['id'])) {
            echo "ID da cadeira não informado para exclusão.";
            return;
        }
        // Dados POST
        $id = (int)$_POST['id'];

        $deleteCadeira = new Cadeira();

        $deleteCadeira->setId($id);

        $resultado = $cadeiraDAO->delete($deleteCadeira);

        print_r($resultado);
    }
}