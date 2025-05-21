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
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Erro ao buscar ingressos: " . $e->getMessage());
        }
    }

    public function getBySessao(Sessao $sessao) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM " . self::tableName . " WHERE sessao_id = :sessao_id");
            $sessao_id = $sessao->get_id();
            $stmt->bindParam(':sessao_id', $sessao_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Erro ao buscar por sessão: " . $e->getMessage());
        }
    }

    public function getByCadeira(Cadeira $cadeira) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM " . self::tableName . " WHERE cadeira_id = :cadeira_id");
            $cadeira_id = $cadeira->get_id();
            $stmt->bindParam(':cadeira_id', $cadeira_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Erro ao buscar por cadeira: " . $e->getMessage());
        }
    }

    public function getByFormaPagamento(Forma_pagamento $forma_pagamento) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM " . self::tableName . " WHERE forma_pagamento_id = :forma_pagamento_id");
            $forma_pagamento_id = $forma_pagamento->get_id();
            $stmt->bindParam(':forma_pagamento_id', $forma_pagamento_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Erro ao buscar por forma de pagamento: " . $e->getMessage());
        }
    }

    public function create(Ingresso $ingresso) {
        try {
            $this->conexao->beginTransaction();

            $stmt = $this->conexao->prepare(
                "INSERT INTO " . self::tableName . " (sessao_id, cadeira_id, forma_pagamento_id, preco, status)
                VALUES (:sessao_id, :cadeira_id, :forma_pagamento_id, :preco, :status)"
            );

            $stmt->bindValue(':sessao_id', $ingresso->get_sessao_id(), PDO::PARAM_INT);
            $stmt->bindValue(':cadeira_id', $ingresso->get_cadeira_id(), PDO::PARAM_INT);
            $stmt->bindValue(':forma_pagamento_id', $ingresso->get_forma_pagamento_id(), PDO::PARAM_INT);
            $stmt->bindValue(':preco', $ingresso->get_preco(), PDO::PARAM_STR);
            $stmt->bindValue(':status', $ingresso->get_status(), PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();
                return [
                    'success' => true,
                    'message' => 'Ingresso adicionado!',
                    'id' => $this->conexao->lastInsertId(),
                ];
            }

            $this->conexao->rollBack();
            return ['success' => false, 'message' => 'Falha ao inserir o ingresso'];

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("Erro ao adicionar ingresso: " . $e->getMessage());
        }
    }

    public function update(Ingresso $ingresso) {
        try {
            $this->conexao->beginTransaction();

            if (!$ingresso->get_id()) {
                return ['success' => false, 'message' => 'ID é obrigatório para atualizar o ingresso'];
            }

            $stmt = $this->conexao->prepare(
                "UPDATE " . self::tableName . " SET preco = :preco WHERE id = :id"
            );

            $stmt->bindValue(':id', $ingresso->get_id(), PDO::PARAM_INT);
            $stmt->bindValue(':preco', $ingresso->get_preco(), PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();
                return ['success' => true, 'message' => 'Ingresso atualizado com sucesso!'];
            }

            $this->conexao->rollBack();
            return ['success' => false, 'message' => 'Nenhuma alteração feita'];

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("Erro ao atualizar o ingresso: " . $e->getMessage());
        }
    }

    public function delete(Ingresso $ingresso) {
        try {
            $this->conexao->beginTransaction();

            if (!$ingresso->get_id()) {
                return ['success' => false, 'message' => 'ID é obrigatório para deletar o ingresso'];
            }

            $stmt = $this->conexao->prepare(
                "UPDATE " . self::tableName . " SET status = 'cancelado' WHERE id = :id"
            );

            $stmt->bindValue(':id', $ingresso->get_id(), PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();
                return ['success' => true, 'message' => 'Ingresso cancelado com sucesso!'];
            }

            $this->conexao->rollBack();
            return ['success' => false, 'message' => 'Nenhuma alteração feita'];

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("Erro ao deletar o ingresso: " . $e->getMessage());
        }
    }
}
