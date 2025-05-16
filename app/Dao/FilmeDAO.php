<?php

require_once '../Connection/DataConnection.php';
require_once '../Model/Filme.php';
Class FilmeDAO
{
    private $conexao;

    private const tableName = 'filmes';

    public function __construct(){
        $this->conexao = DataConnection::getConnection();
    }

    /**
     * @param int $idfilme
     *
     * @return mixed
     */
    public function first(int $idfilme)
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
    public function get()
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
    public function create(Filme $filme)
    {
        try {

            $this->conexao->beginTransaction();

            $dataFormularioFilme = [
                'nome' => $filme->getNomeFilme(),
                'descricao' => $filme->getDescricaoFilme(),
                'duracao' => $filme->getDuracaoFilme(),
            ];

            $stmt = $this->conexao->prepare(
                "INSERT INTO " . self::tableName . "(nome, descricao, duracao) 
                VALUES (:nome, :descricao, :duracao)"
            );

            $stmt->bindParam(':nome', $dataFormularioFilme['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $dataFormularioFilme['descricao'], PDO::PARAM_STR);
            $stmt->bindParam(':duracao', $dataFormularioFilme['duracao'], PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Filme cadastrado com sucesso!',
                    'id' => $this->conexao->lastInsertId()
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
    public function update(Filme $filme)
    {
        try {
            $this->conexao->beginTransaction();

            if($filme->getId() == 0 || $filme->getId() == '' || $filme->getId() == ' ' || !$filme->getId()) {
                return [
                    'success' => false,
                    'message' => 'O id e obrigatorio para atualizar um filme'
                ];
            }

            $dataFormularioUpdate = [
                'id' => $filme->getId(),
                'nome' => $filme->getNomeFilme(),
                'descricao' => $filme->getDescricaoFilme(),
                'duracao' => $filme->getDuracaoFilme()
            ];

            $stmt = $this->conexao->prepare(
                "UPDATE " . self::tableName . " SET nome = :nome, descricao = :descricao, duracao = :duracao WHERE id = :id"
            );

            $stmt->bindParam(':id', $dataFormularioUpdate['id'], PDO::PARAM_INT);
            $stmt->bindParam(':nome', $dataFormularioUpdate['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $dataFormularioUpdate['descricao'], PDO::PARAM_STR);
            $stmt->bindParam(':duracao', $dataFormularioUpdate['duracao'], PDO::PARAM_STR);

            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                  'success' => true,
                  'message' => 'Filme atualizado com sucesso!'
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
    public function delete(Filme $filme)
    {
        try {
            $this->conexao->beginTransaction();

            if($filme->getId() == 0 || $filme->getId() == '' || $filme->getId() == ' ' || !$filme->getId()) {
                return [
                    'success' => false,
                    'message' => 'O id e obrigatorio para delete suave do filme'
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

            if($stmt->rowCount() > 0) {
                $this->conexao->commit();

                return [
                    'success' => true,
                    'message' => 'Filme deletado com sucesso!'
                ];
            }

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao deletar o filme" . $e->getMessage());
        }
    }

}