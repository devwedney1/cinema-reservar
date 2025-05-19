<?php

require_once '../Connection/DataConnection.php';
require_once '../Model/Filme.php';

class FilmeDAO
{
    private $conexao;
    private const tableName = 'filmes';

    public function __construct ()
    {
        $this->conexao = DataConnection::getConnection();
    }

    /**
     * @param int $idfilme
     *
     * @return mixed
     */
    public function first (int $idfilme)
    {
        try {

            $query = "SELECT * FROM " . self::tableName . " where id = :idfilme LIMIT 1";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':idfilme', $idfilme, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar um filme" . $e->getMessage());
        }
    }

    /**
     * @return array
     */
    public function get ()
    {
        try {
            $stmt = $this->conexao->query("SELECT * FROM" . self::tableName);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar um filme" . $e->getMessage());
        }
    }

    /**
     * @param Filme $filme
     *
     * @return array|void
     */
    public function create (Filme $filme)
    {
        try {

            $this->conexao->beginTransaction();

            $dataFormularioFilme = [
                'nome_filme' => $filme->getNomeFilme(),
                'descricao_filme' => $filme->getDescricaoFilme(),
                'duracao_filme' => $filme->getDuracaoFilme(),
            ];

            $stmt = $this->conexao->prepare(
                "INSERT INTO " . self::tableName . "(nome_filme, descricao_filme, duracao_filme) 
                VALUES (:nome_filme, :descricao_filme, :duracao_filme)"
            );

            $stmt->bindParam(':nome_filme', $dataFormularioFilme['nome_filme'], PDO::PARAM_STR);
            $stmt->bindParam(':descricao_filme', $dataFormularioFilme['descricao_filme'], PDO::PARAM_STR);
            $stmt->bindParam(':duracao_filme', $dataFormularioFilme['duracao_filme'], PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Filme cadastrado com sucesso!',
                    'id' => $this->conexao->lastInsertId(),
                ];
            }
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao cadastra um filme" . $e->getMessage());
        }
    }

    /**
     * @param Filme $filme
     *
     * @return array|void
     */
    public function update (Filme $filme)
    {
        try {
            $this->conexao->beginTransaction();

            if ($filme->getId() == 0 || $filme->getId() == '' || $filme->getId() == ' ' || !$filme->getId()) {
                return [
                    'success' => false,
                    'message' => 'O id e obrigatorio para atualizar um filme',
                ];
            }

            $dataFormularioUpdate = [
                'id' => $filme->getId(),
                'nome_filme' => $filme->getNomeFilme(),
                'descricao_filme' => $filme->getDescricaoFilme(),
                'duracao_filme' => $filme->getDuracaoFilme(),
            ];

            $stmt = $this->conexao->prepare(
                "UPDATE " . self::tableName . " SET nome_filme = :nome_filme, descricao_filme = :descricao_filme, duracao_filme = :duracao_filme WHERE id = :id"
            );

            $stmt->bindParam(':id', $dataFormularioUpdate['id'], PDO::PARAM_INT);
            $stmt->bindParam(':nome_filme', $dataFormularioUpdate['nome_filme'], PDO::PARAM_STR);
            $stmt->bindParam(':descricao_filme', $dataFormularioUpdate['descricao_filme'], PDO::PARAM_STR);
            $stmt->bindParam(':duracao_filme', $dataFormularioUpdate['duracao_filme'], PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Filme atualizado com sucesso!',
                ];
            }

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao atualizar o filme" . $e->getMessage());
        }
    }

    /**
     * @param Filme $filme
     *
     * @return array|void
     */
    public function delete (Filme $filme)
    {
        try {
            $this->conexao->beginTransaction();

            if ($filme->getId() == 0 || $filme->getId() == '' || $filme->getId() == ' ' || !$filme->getId()) {
                return [
                    'success' => false,
                    'message' => 'O id e obrigatorio para delete suave do filme',
                ];
            }

            $dataFormularioDelete = [
                'id' => $filme->getId(),
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
                    'message' => 'Filme deletado com sucesso!',
                ];
            }

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao deletar o filme" . $e->getMessage());
        }
    }

    /**
     * @param int $idFilme
     *
     * @return array|void
     */
    public function destroy (int $idFilme)
    {
        try {
            $this->conexao->beginTransaction();

            $stmt = $this->conexao->prepare(
                'DELETE FROM ' . self::tableName . ' WHERE id = :id'
            );

            $stmt->bindParam(':id', $idFilme, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Filme deletado com sucesso!',
                ];
            }

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao deleta para sempre r o filme" . $e->getMessage());
        }
    }
}