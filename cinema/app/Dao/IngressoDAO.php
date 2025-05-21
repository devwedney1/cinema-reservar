<?php

require_once '../Connection/DataConnection.php';
require_once '../Model/Ingresso.php';

class IngressoDAO {
    private $conexao;
    private const tableName = 'ingressos';

    public function __construct() {
        $this->conexao = DataConnection::get_connection();
    }

    public function get() {
        try {
            $stmt = $this->conexao->query("SELECT * FROM " . self::tableName);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar um ingresso" . $e->get_message());
        }
    }

    public function get_bySessao(Sessao $sessao) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM " . self::tableName . " WHERE sessao_id = :sessao_id");

            $sessao_id = $sessao->get_id();
            $stmt->bindParam(':sessao_id', $sessao_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar por sessao " . $e->get_message());
        }
    }

    public function get_byCadeira(Cadeira $cadeira) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM " . self::tableName . " WHERE cadeira_id = :cadeira_id");

            $cadeira_id = $cadeira->get_id();
            $stmt->bindParam(':cadeira_id', $cadeira_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar por cadeira " . $e->get_message());
        }
    }

    public function get_byFormaPagamento(Forma_pagamento $forma_pagamento) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM " . self::tableName . " WHERE forma_pagamento_id = :forma_pagamento_id");

            $forma_pagamento_id = $forma_pagamento->get_id();
            $stmt->bindParam(':forma_pagamento_id', $forma_pagamento_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar por forma de pagamento " . $e->get_message());
        }
    }

    public function create(Ingresso $ingresso)
    {
        try {
            $this->conexao->beginTransaction();

            $dataFormularioIngresso = [
                'preco' => $ingresso->get_preco(),
                'status' => $ingresso->get_status(),
            ];

            $stmt = $this->conexao->prepare(
                "INSERT INTO " . self::tableName . "(preco, status) 
                VALUES (:preco, :status)"
            );

            $stmt->bindParam(':preco', $dataFormularioIngresso['preco'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $dataFormularioIngresso['status'], PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Ingresso adicionado!',
                    'id' => $this->conexao->lastInsertId(),
                ];
            } else {
                $this->conexao->rollBack();
                return [
                    'success' => false,
                    'message' => 'Falha ao inserir o ingresso',
                ];
            }

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao adicionar ingresso " . $e->get_message());
        }
        
    }

    public function update(Ingresso $ingresso)
    {
        try {
            $this->conexao->beginTransaction();

            if ($ingresso->get_id() == 0 || $ingresso->get_id() == '' || $ingresso->get_id() == ' ' || !$ingresso->get_id()) {
                return [
                    'success' => false,
                    'message' => 'O id é obrigatório para atualizar o ingresso',
                ];
            }

            $dataFormularioUpdate = [
                'id' => $ingresso->get_id(),
                'preco' => $ingresso->get_preco(),
            ];

            $stmt = $this->conexao->prepare(
                "UPDATE " . self::tableName . " SET preco = :preco WHERE id = :id"
            );

            $stmt->bindParam(':id', $dataFormularioUpdate['id'], PDO::PARAM_INT);
            $stmt->bindParam(':preco', $dataFormularioUpdate['preco'], PDO::PARAM_STR);
          
            $stmt->execute();


            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Ingresso atualizado com sucesso!',
                ];
            } else {
                $this->conexao->rollBack();
                return [
                    'success' => false,
                    'message' => 'Nenhuma alteração feita',
                ];
            }
        }  catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao atualizar o ingresso " . $e->get_message());
        }
    }

    public function delete(Ingresso $ingresso) {
        try {
            $this->conexao->beginTransaction();
            
            if ($ingresso->get_id() == 0 || $ingresso->get_id() == '' || $ingresso->get_id() == ' ' || !$ingresso->get_id()) {
                return [
                    'success' => false,
                    'message' => 'O id é obrigatório para deletar um ingresso',
                ];
            }

            $dataFormularioDelete = [
                'id' => $ingresso->get_id(),
            ];



            $stmt = $this->conexao->prepare(
                'UPDATE ' . self::tableName . ' SET status = "cancelado" WHERE id = :id'
            );
            $stmt->bindParam(':id', $dataFormularioDelete['id'], PDO::PARAM_INT);
            $stmt->execute();



            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Ingresso cancelado com sucesso!',
                ];
            }
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao deletar o ingresso " . $e->get_message());
        }
    }
}