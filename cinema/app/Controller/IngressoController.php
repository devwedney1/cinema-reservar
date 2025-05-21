<?php
require_once '../Connection/DataConnection.php';
require_once '../Dao/IngressoDAO.php';
require_once '../Model/Ingresso.php';
require_once '../Model/Sessao.php';
require_once '../Model/Cadeira.php';
require_once '../Model/Forma_pagamento.php';

class IngressoController {
    public function ListarIngressos() {
        $ingressoDAO = new IngressoDAO();

        $listaDeIngressos = $ingressoDAO->get();

        print_r($listaDeIngressos);
    }

    //public function ListarIngressosPorSessao() {
    //    $ingressoDAO = new IngressoDAO();
    //    if (!isset($_GET['sessao_id']) || !is_numeric($_GET['sessao_id'])) {
    //        echo "ID da sessão não informado ou inválido.";
    //        return;
    //    }
    //
   //     $sessao_id = (int)$_GET['sessao_id'];
    //
    //    $sessao = new Sessao();
    //    $sessao->set_id($sessao_id);
    //
    //    $resultado = $ingressoDAO->get_bySessao($sessao);
    //
    //    print_r($resultado);
    //}

    //public function ListarIngressosPorCadeira() {
    //    $ingressoDAO = new IngressoDAO();
    //    if (!isset($_GET['cadeira_id']) || !is_numeric($_GET['cadeira_id'])) {
    //        echo "ID da cadeira não informado ou inválido.";
    //        return;
    //    }
    //
    //    $cadeira_id = (int)$_GET['cadeira_id'];
    //
    //    $cadeira = new Cadeira();
    //    $cadeira->set_id($cadeira_id);
    //
    //    $resultado = $ingressoDAO->get_byCadeira($cadeira);
    //
    //    print_r($resultado);
    //}

    //public function ListarIngressosPorFormaPagamento() {
    //    $ingressoDAO = new IngressoDAO();
    //    if (!isset($_GET['forma_pagamento_id']) || !is_numeric($_GET['forma_pagamento_id'])) {
    //        echo "ID da forma de pagamento não informado ou inválido.";
    //        return;
    //    }
    //
    //    $forma_pagamento_id = (int)$_GET['forma_pagamento_id'];
    //
    //    $forma_pagamento = new Forma_pagamento();
    //    $forma_pagamento->set_id($forma_pagamento_id);
    //
    //    $resultado = $ingressoDAO->get_byFormaPagamento($forma_pagamento);
    //
    //   print_r($resultado);
    //}

    public function CriarIngresso() {
        $ingressoDAO = new IngressoDAO();
        if (!isset($_POST['preco']) || !isset($_POST['status'])) {
            echo "Dados incompletos para cadastrar o Ingresso.";
            return;
        }

        $preco = (float)$_POST['preco'];
        $status = $_POST['status'];

        $novoIngresso = new Ingresso();
        $novoIngresso->set_preco($preco);
        $novoIngresso->set_status($status);

        $resultado = $ingressoDAO->create($novoIngresso);

        print_r($resultado);
    }

    public function AtualizarIngresso() {
        $ingressoDAO = new IngressoDAO();
        if (!isset($_POST['id']) || !isset($_POST['preco'])) {
            echo "Dados incompletos para atualizar o Ingresso.";
            return;
        }

        $id = (int)$_POST['id'];
        $preco = (float)$_POST['preco'];

        $updateIngresso = new Ingresso();
        $updateIngresso->set_id($id);
        $updateIngresso->set_preco($preco);

        $resultado = $ingressoDAO->update($updateIngresso);
    }

    public function DeletarIngresso() {
        $ingressoDAO = new IngressoDAO();
        if (!isset($_POST['id'])) {
            echo "ID do ingresso não informado para a exclusão";
            return;
        }

        // Dados POST
        $id = (int)$_POST['id'];

        $deleteIngresso = new Ingresso();
        $deleteIngresso->set_id($id);

        $resultado = $ingressoDAO->delete($deleteIngresso);

        print_r($resultado);
    }
}