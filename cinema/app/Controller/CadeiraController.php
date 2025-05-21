<?php

require_once __DIR__ . '/../Dao/CadeiraDAO.php';
require_once __DIR__ . '/../Dao/SalaDAO.php';
require_once __DIR__ . '/../Model/Cadeira.php';
require_once __DIR__ . '/../Model/Sala.php';

class CadeiraController
{
    public function ListarCadeiras()
    {
        $cadeiraDAO = new CadeiraDAO();
        $cadeiras = $cadeiraDAO->get();
        header('Content-Type: application/json');
        echo json_encode($cadeiras);
    }

    public function ListarCadeirasPorSala()
    {
        if (!isset($_GET['sala_id']) || !is_numeric($_GET['sala_id'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Parâmetro sala_id inválido."]);
            return;
        }

        $sala = new Sala();
        $sala->set_id((int)$_GET['sala_id']);

        $cadeiraDAO = new CadeiraDAO();
        $cadeiras = $cadeiraDAO->get_bySala($sala);
        header('Content-Type: application/json');
        echo json_encode($cadeiras);
    }

    public function CriarCadeira()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['sala_id'], $input['numero_cadeira'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Campos obrigatórios não informados."]);
            return;
        }

        $sala = new Sala();
        $sala->set_id((int)$input['sala_id']);

        $cadeira = new Cadeira();
        $cadeira->set_sala($sala);
        $cadeira->set_numeroCadeira((int)$input['numero_cadeira']);

        $dao = new CadeiraDAO();
        echo json_encode($dao->create($cadeira));
    }

    public function AtualizarCadeira()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['id'], $input['numero_cadeira'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Campos obrigatórios não informados."]);
            return;
        }

        $cadeira = new Cadeira();
        $cadeira->set_id((int)$input['id']);
        $cadeira->set_numeroCadeira((int)$input['numero_cadeira']);

        $dao = new CadeiraDAO();
        echo json_encode($dao->update($cadeira));
    }

    public function DeletarCadeira()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Parâmetro id inválido."]);
            return;
        }

        $cadeira = new Cadeira();
        $cadeira->set_id((int)$_GET['id']);

        $dao = new CadeiraDAO();
        echo json_encode($dao->delete($cadeira));
    }
}
