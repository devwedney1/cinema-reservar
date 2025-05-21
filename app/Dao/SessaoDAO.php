<?php
require_once '../Connection/DataConnection.php';
require_once '../Model/Sessao.php';

class SessaoDAO {
    private $conexao;
    private const tableName = 'sessoes_filmes';

    public function __construct() {
        $this->conexao = DataConnection::get_connection();
    }

    public function get() {
        try {
            $stmt = $this->conexao->query("SELECT * FROM " . self::tableName);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }   catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar as sessoes" . $e->get_message());
        }
    }

    public function get_byFilmeId(Filme $filme) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM " . self::tableName . " WHERE filme_id = :filme_id");

            $filme_id = $filme->get_id();
            $stmt->bindParam(':filme_id', $filme_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar sessões por filme: " . $e->get_message());
        }
    }

    public function get_bySalaId(Sala $sala) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM " . self::tableName . " WHERE sala_id = :sala_id");

            $sala_id = $sala->get_id();
            $stmt->bindParam(':sala_id', $sala_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar sessões por sala: " . $e->get_message());
        }
    }

    public function create(Sessao $sessao) {
        try {
            $this->conexao->beginTransaction();

            $dataFormularioSessao = [
                'filme_id' => $sessao->get_filme_id(),
                'sala_id' => $sessao->get_sala_id(),
            ];

            $stmt = $this->conexao->prepare(
                "INSERT INTO " . self::tableName . "(filme_id, sala_id) 
                VALUES (:filme_id, :sala_id)"
            );

            $stmt->bindParam(':filme_id', $dataFormularioSessao['filme_id'], PDO::PARAM_INT);
            $stmt->bindParam(':sala_id', $dataFormularioSessao['sala_id'], PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Sessão cadastrada com sucesso!',
                    'id' => $this->conexao->lastInsertId(),
                ];
            }

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao criar uma sessão: " . $e->get_message());
        }
    }

    public function update(Sessao $sessao)
    {
        try {
            $this->conexao->beginTransaction();

            if ($sessao->get_id() == 0 || $sessao->get_id() == '' || $sessao->get_id() == ' ' || !$sessao->get_id()) {
                return [
                    'success' => false,
                    'message' => 'O id é obrigatorio para atualizar uma sessão',
                ];
            }

            $dataFormularioUpdate = [
                'id' => $sessao->get_id(),
                'filme_id' => $sessao->get_filme_id(),
                'sala_id' => $sessao->get_sala_id(),
            ];

            $stmt = $this->conexao->prepare(
                "UPDATE " . self::tableName . " SET filme_id = :filme_id, sala_id = :sala_id WHERE id = :id"
            );

            $stmt->bindParam(':id', $dataFormularioUpdate['id'], PDO::PARAM_INT);
            $stmt->bindParam(':filme_id', $dataFormularioUpdate['filme_id'], PDO::PARAM_INT);
            $stmt->bindParam(':sala_id', $dataFormularioUpdate['sala_id'], PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Sessão atualizada com sucesso!',
                ];
            }
        }  catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao atualizar a sessão: " . $e->get_message());
        }
    }

    public function delete(Sessao $sessao) {
        try {
            $this->conexao->beginTransaction();
            
            if ($sessao->get_id() == 0 || $sessao->get_id() == '' || $sessao->get_id() == ' ' || !$sessao->get_id()) {
                return [
                    'success' => false,
                    'message' => 'O id é obrigatório para deletar uma sessão',
                ];
            }

            $dataFormularioDelete = [
                'id' => $sessao->get_id(),
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
                    'message' => 'Sessão deletada com sucesso!',
                ];
            }
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao deletar a sessão " . $e->get_message());
        }
    }
}