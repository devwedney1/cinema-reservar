<?php
require_once '../Connection/DataConnection.php';
require_once '../Dao/SalaDAO.php';
require_once '../Model/Sala.php';

class SalaController {
    public function ListarSalas() {
        $salaDAO = new SalaDAO();

        $listaDeSalas = $salaDAO->get();

        print_r($listaDeSalas);
    }

    public function CriarSala() {
        $salaDAO = new SalaDAO();

        if (!isset($_POST['nome_sala'])) {
            echo "Dados incompletos para criar a sala.";
            return;
        }
        // Dados POST
        $nome_sala = $_POST['nome_sala'];

        $novaSala = new Sala();
        $novaSala->set_nome_sala($nome_sala);

        $resultado = $salaDAO->create($novaSala);

        print_r($resultado);
    }

    public function AtualizarSala() {
        $salaDAO = new SalaDAO();

        if (!isset($_POST['id']) || !isset($_POST['nome_sala'])) {
            echo "Dados incompletos para atualizar a sala.";
            return;
        }

        // Dados POST
        $id = (int)$_POST['id'];
        $nome_sala = $_POST['nome_sala'];

        $updateSala = new Sala();
        $updateSala->set_id($id);
        $updateSala->set_nome_sala($nome_sala);

        $resultado = $salaDAO->update($updateSala);

        print_r($resultado);
    }

    public function DeletarSala() {
        $salaDAO = new SalaDAO();

        if (!isset($_POST['id'])) {
            echo "ID da sala não informado para a exclusão.";
            return;
        }

        // Dados POST
        $id = (int)$_POST['id'];

        $deleteSala = new Sala();
        $deleteSala->set_id($id);

        $resultado = $salaDAO->delete($deleteSala);

        print_r($resultado);
    }
}