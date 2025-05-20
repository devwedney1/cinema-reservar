<?php

require_once '../Connection/DataConnection.php';
require_once '../Model/Ingresso.php';

class IngressoDAO {
    private $conexao;
    private const tableName = 'ingressos';

    public function __construct() {
        $this->conexao = DataConnection::getConnection();
    }

    public function get() {
        try {
            $stmt = $this->conexao->query("SELECT * FROM " . self::tableName);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar um ingresso" . $e->getMessage());
        }
    }

    public function getBySessao(Sessao $sessao) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM " . self::tableName . " WHERE sessao_id = :sessao_id");

            $sessao_id = $sessao->getId();
            $stmt->bindParam(':sessao_id', $sessao_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar por sessao " . $e->getMessage());
        }
    }

    public function getByCadeira(Cadeira $cadeira) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM " . self::tableName . " WHERE cadeira_id = :cadeira_id");

            $cadeira_id = $cadeira->getId();
            $stmt->bindParam(':cadeira_id', $cadeira_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar por cadeira " . $e->getMessage());
        }
    }

    public function getByFormaPagamento(Forma_pagamento $forma_pagamento) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM " . self::tableName . " WHERE forma_pagamento_id = :forma_pagamento_id");

            $forma_pagamento_id = $forma_pagamento->getId();
            $stmt->bindParam(':forma_pagamento_id', $forma_pagamento_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar por forma de pagamento " . $e->getMessage());
        }
    }

    public function create(Ingresso $ingresso)
    {
        try {
            $this->conexao->beginTransaction();

            $dataFormularioIngresso = [
                'sessao_id' => $ingresso->getSessao_id(),
                'cadeira_id' => $ingresso->getCadeira_id(),
                'forma_pagamento_id' => $ingresso->getForma_pagamento_id(),
                'preco' => $ingresso->getPreco(),
                'status' => $ingresso->getStatus(),
            ];

            $stmt = $this->conexao->prepare(
                "INSERT INTO " . self::tableName . "(sessao_id, cadeira_id, forma_pagamento_id, preco, status) 
                VALUES (:sessao_id, :cadeira_id, :forma_pagamento_id, :preco, :status)"
            );

            $stmt->bindParam(':sessao_id', $dataFormularioIngresso['sessao_id'], PDO::PARAM_INT);
            $stmt->bindParam(':cadeira_id', $dataFormularioIngresso['cadeira_id'], PDO::PARAM_INT);
            $stmt->bindParam(':forma_pagamento_id', $dataFormularioIngresso['forma_pagamento_id'], PDO::PARAM_INT);
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
            throw new PDOException("ERRO ao adicionar ingresso " . $e->getMessage());
        }
        
    }

    public function update(Ingresso $ingresso)
    {
        try {
            $this->conexao->beginTransaction();

            if ($ingresso->getCadeira_id() == 0 || $ingresso->getCadeira_id() == '' || $ingresso->getCadeira_id() == ' ' || !$ingresso->getCadeira_id()) {
                return [
                    'success' => false,
                    'message' => 'O id da cadeira é obrigatório para atualizar o ingresso',
                ];
            }

            $dataFormularioUpdate = [
                'id' => $ingresso->getId(),
                'sessao_id' => $ingresso->getSessao_id(),
                'cadeira_id' => $ingresso->getCadeira_id(),
                'forma_pagamento_id' => $ingresso->getForma_pagamento_id(),
                'preco' => $ingresso->getPreco(),

            ];

            $stmt = $this->conexao->prepare(
                "UPDATE " . self::tableName . " SET sessao_id = :sessao_id, 
                forma_pagamento_id = :forma_pagamento_id, preco = :preco, vendido_em = NOW() WHERE cadeira_id = :cadeira_id"
            );

            $stmt->bindParam(':id', $dataFormularioUpdate['id'], PDO::PARAM_INT);
            $stmt->bindParam(':sessao_id', $dataFormularioUpdate['sessao_id'], PDO::PARAM_INT);
            $stmt->bindParam(':cadeira_id', $dataFormularioUpdate['cadeira_id'], PDO::PARAM_INT);
            $stmt->bindParam(':forma_pagamento_id', $dataFormularioUpdate['forma_pagamento_id'], PDO::PARAM_INT);
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
            throw new PDOException("ERRO ao atualizar o ingresso " . $e->getMessage());
        }
    }

    public function delete(Ingresso $ingresso) {
        try {
            $this->conexao->beginTransaction();
            
            if ($ingresso->getCadeira_id() == 0 || $ingresso->getCadeira_id() == '' || $ingresso->getCadeira_id() == ' ' || !$ingresso->getCadeira_id()) {
                return [
                    'success' => false,
                    'message' => 'O id da cadeira é obrigatório para deletar um ingresso',
                ];
            }

            $dataFormularioDelete = [
                'cadeira_id' => $ingresso->getCadeira_id(),
            ];



            $stmt = $this->conexao->prepare(
                'UPDATE ' . self::tableName . ' SET status = "cancelado" WHERE cadeira_id = :cadeira_id'
            );
            $stmt->bindParam(':cadeira_id', $dataFormularioDelete['cadeira_id'], PDO::PARAM_INT);
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
            throw new PDOException("ERRO ao deletar o ingresso " . $e->getMessage());
        }
    }
}