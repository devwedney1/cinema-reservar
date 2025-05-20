<?php

require_once '../Connection/DataConnection.php';
require_once '../Model/Sala.php';

class SalaDAO {
    private $conexao;
    private const tableName = 'salas';

    public function __construct() {
        $this->conexao = DataConnection::getConnection();
    }

    public function get() {
        try {
            $stmt = $this->conexao->query("SELECT * FROM " . self::tableName);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar uma sala" . $e->getMessage());
        }
    }

    public function create(Sala $sala)
    {
        try {
            $this->conexao->beginTransaction();

            $dataFormularioSala = [
                'nome_sala' => $sala->getNome_sala(),
            ];

            $stmt = $this->conexao->prepare(
                "INSERT INTO " . self::tableName . "(nome_sala) 
                VALUES (:nome_sala)"
            );

            $stmt->bindParam(':nome_sala', $dataFormularioIngresso['nome_sala'], PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Sala criada!',
                    'id' => $this->conexao->lastInsertId(),
                ];
            } else {
                $this->conexao->rollBack();
                return [
                    'success' => false,
                    'message' => 'Falha ao criar a sala',
                ];
            }

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao criar sala " . $e->getMessage());
        }
        
    }

    public function update(Sala $sala)
    {
        try {
            $this->conexao->beginTransaction();

            if ($sala->getId() == 0 || $sala->getId() == '' || $sala->getId() == ' ' || !$sala->getId()) {
                return [
                    'success' => false,
                    'message' => 'O id da sala é obrigatório para atualizar a sala',
                ];
            }

            $dataFormularioUpdate = [
                'id' => $sala->getId(),
                'nome_sala' => $sala->getNome_sala(),
            ];

            $stmt = $this->conexao->prepare(
                "UPDATE " . self::tableName . " SET nome_sala = :nome_sala WHERE id = :id"
            );

            $stmt->bindParam(':id', $dataFormularioUpdate['id'], PDO::PARAM_INT);
            $stmt->bindParam(':nome_sala', $dataFormularioUpdate['nome_sala'], PDO::PARAM_STR);
     
            $stmt->execute();


            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Sala atualizada com sucesso!',
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
            throw new PDOException("ERRO ao atualizar a sala " . $e->getMessage());
        }
    }

    public function delete(Sala $sala) {
        try {
            $this->conexao->beginTransaction();
            
            if ($ingresso->getId() == 0 || $ingresso->getId() == '' || $ingresso->getId() == ' ' || !$ingresso->getId()) {
                return [
                    'success' => false,
                    'message' => 'O id é obrigatório para deletar a sala',
                ];
            }

            $dataFormularioDelete = [
                'id' => $sala->getId(),
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
                    'message' => 'Sala deletada com sucesso!',
                ];
            }
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao deletar a sala " . $e->getMessage());
        }
    }
}