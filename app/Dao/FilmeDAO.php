<?php

require_once '../Connection/DataConnection.php';
require_once '../Model/Filme.php';

class FilmeDAO
{
    /**
     * @var PDO|null
     */
    private $conexao;
    private const tableName = 'filmes';
    private const tableNameCategoria = 'categoria_filmes';

    public function __construct ()
    {
        $this->conexao = DataConnection::get_connection();
    }

    /**
     * @param int $idfilme
     * @param int $idCategoriaFilme
     *
     * @return Filme|null
     */
    public function first (int $idfilme, int $idCategoriaFilme): ?Filme
    {
        try {

            $sql = "SELECT f.*, c.nome_categoria FROM  " . self::tableName . " f INNER JOIN " . self::tableNameCategoria . " c ON f.categoria_filme_id = c.id" . " where f.id = :idfilme LIMIT 1";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':idfilme', $idfilme, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $returnFilme = null;

            if($row) {
                $CategoriaFilme = new CategoriaFilme($row['categoria_filme_id'], $row['nome_categoria']);
                $filme = new Filme(
                    (int) $row['id'],
                    $row['nome_filme'],
                    $row['descricao_filme'],
                    $row['duracao_filme'],
                    (int) $row['categoria_filme_id'],
                    $CategoriaFilme
                );
                $returnFilme = $filme;
            }

            return $returnFilme;
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar um filme" . $e->get_message());
        }
    }


    /**
     * @return array
     */
    public function get (): array
    {
        try {
            $sql = "SELECT f.*, c.nome_categoria FROM  " . self::tableName . " f LEFT JOIN " . self::tableNameCategoria . " c ON f.categoria_filme_id = c.id";
            $stmt = $this->conexao->query($sql);
            $filmes = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $CategoriaFilme = new CategoriaFilme($row['categoria_filme_id'], $row['nome_categoria']);
                $filme = new Filme(
                    (int) $row['id'],
                    $row['nome_filme'],
                    $row['descricao_filme'],
                    $row['duracao_filme'],
                    (int) $row['categoria_filme_id'],
                    $CategoriaFilme
                );
                $filmes[] = $filme;
            }

            return $filmes;
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar um filme" . $e->get_message());
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
                'nome_filme' => $filme->get_nomeFilme(),
                'descricao_filme' => $filme->get_descricaoFilme(),
                'duracao_filme' => $filme->get_duracaoFilme(),
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
            throw new PDOException("ERRO ao cadastra um filme" . $e->get_message());
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

            if ($filme->get_id() == 0 || $filme->get_id() == '' || $filme->get_id() == ' ' || !$filme->get_id()) {
                return [
                    'success' => false,
                    'message' => 'O id e obrigatorio para atualizar um filme',
                ];
            }

            $dataFormularioUpdate = [
                'id' => $filme->get_id(),
                'nome_filme' => $filme->get_nomeFilme(),
                'descricao_filme' => $filme->get_descricaoFilme(),
                'duracao_filme' => $filme->get_duracaoFilme(),
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
            throw new PDOException("ERRO ao atualizar o filme" . $e->get_message());
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

            if ($filme->get_id() == 0 || $filme->get_id() == '' || $filme->get_id() == ' ' || !$filme->get_id()) {
                return [
                    'success' => false,
                    'message' => 'O id e obrigatorio para delete suave do filme',
                ];
            }

            $dataFormularioDelete = [
                'id' => $filme->get_id(),
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
            throw new PDOException("ERRO ao deletar o filme" . $e->get_message());
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
            throw new PDOException("ERRO ao deleta para sempre r o filme" . $e->get_message());
        }
    }
}