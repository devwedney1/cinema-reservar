<?php

require_once '../Connection/DataConnection.php';
require_once '../Model/Cadeira.php';

class CadeiraDAO {
    private $conexao;
    private const tableName = 'cadeiras'

    public function __construct() {
        $this->conexao = DataConnection::getConnection();
    }

    public function get() {
        try {
            $stmt = $this->conexao->query("SELECT * FROM" . self::tableName);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar uma cadeira" . $e->getMessage());
        }
    }

    public function create(Cadeira $cadeira)
    {
        try {
            $this->conexao->beginTransaction();

            $dataFormularioCadeira = [
                'sala_id' => $cadeira->getSala_id(),
                'numero_cadeira' => $cadeira->getNumero_cadeira(),
            ];

            $stmt = $this->conexao->prepare(
                "INSERT INTO " . self::tableName . "(sala_id, numero_cadeira) 
                VALUES (:sala_id, :numero_cadeira)"
            );

            $stmt->bindParam(':sala_id', $dataFormularioCadeira['sala_id'], PDO::PARAM_INT);
            $stmt->bindParam(':numero_cadeira', $dataFormularioCadeira['numero_cadeira'], PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Cadeira cadastrada com sucesso!',
                    'id' => $this->conexao->lastInsertId(),
                ];
            }

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao criar uma cadeira" . $e->getMessage());
        }
        
    }

    public function update(Cadeira $cadeira)
    {
        try {
            $this->conexao->beginTransaction();

            if ($cadeira->getId() == 0 || $cadeira->getId() == '' || $cadeira->getId() == ' ' || !$cadeira->getId()) {
                return [
                    'success' => false,
                    'message' => 'O id e obrigatorio para atualizar uma cadeira',
                ];
            }

            $dataFormularioUpdate = [
                'id' => $cadeira->getId(),
                'sala_id' => $cadeira->getSala_id(),
                'numero_cadeira' => $cadeira->getNumero_cadeira(),
            ];

            $stmt = $this->conexao->prepare(
                "UPDATE " . self::tableName . "SET sala_id = :sala_id, numero_cadeira = :numero_cadeira WHERE id = :id"
            );

            $stmt->bindParam(':id', $dataFormularioUpdate['id'], PDO::PARAM_INT);
            $stmt->bindParam(':sala_id', $dataFormularioUpdate['sala_id'], PDO::PARAM_INT);
            $stmt->bindParam(':numero_cadeira', $dataFormularioUpdate['numero_cadeira'], PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Cadeira atualizada com sucesso!',
                ];
            }
        }  catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao atualizar a cadeira" . $e->getMessage());
        }
    }

    public function delete(Cadeira $cadeira) {
        try {
            $this->conexao->beginTransaction();
            
            if ($cadeira->getId() == 0 || $cadeira->getId() == '' || $cadeira->getId() == ' ' || !$cadeira->getId()) {
                return [
                    'success' => false,
                    'message' => 'O id e obrigatorio para deletar uma cadeira',
                ];
            }

            $dataFormularioDelete = [
                'id' => $cadeira->getId(),
            ];

            $stmt = $this->conexao->prepare(
                'UPDATE ' . self::tableName . ' SET deleted_at = NOW() WHERE id = :id'
            );

            $stmt->bindParam(':id', $dataFormularioDelete['id'], PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Cadeira deletada com sucesso!',
                ];
            }
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao deletar a cadeira" . $e->getMessage());
        }
}