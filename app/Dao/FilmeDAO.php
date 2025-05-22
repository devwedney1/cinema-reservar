<?php

require_once '../Connection/DataConnection.php';
require_once '../Model/Filme.php';
require_once '../Model/CategoriaFilme.php';

class FilmeDAO
{
    private $conexao;
    private const tableName = 'filmes';
    private const tableNameCategoria = 'categoria_filmes';

    public function __construct()
    {
        $this->conexao = DataConnection::get_connection();
    }

    public function first(int $idfilme): ?Filme
    {
        try {
            $sql = "SELECT f.*, c.nome_categoria FROM  " . self::tableName . " f INNER JOIN " . self::tableNameCategoria . " c ON f.categoria_filme_id = c.id WHERE f.id = :idfilme LIMIT 1";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':idfilme', $idfilme, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $categoria = new CategoriaFilme($row['categoria_filme_id'], $row['nome_categoria']);
                return new Filme(
                    (int)$row['id'],
                    $row['nome_filme'],
                    $row['descricao_filme'],
                    $row['duracao_filme'],
                    $categoria
                );
            }

            return null;
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar um filme: " . $e->getMessage());
        }
    }

    public function get(): array
    {
        try {
            $sql = "SELECT f.*, c.nome_categoria FROM  " . self::tableName . " f LEFT JOIN " . self::tableNameCategoria . " c ON f.categoria_filme_id = c.id";
            $stmt = $this->conexao->query($sql);
            $filmes = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categoria = new CategoriaFilme($row['categoria_filme_id'], $row['nome_categoria']);
                $filmes[] = new Filme(
                    (int)$row['id'],
                    $row['nome_filme'],
                    $row['descricao_filme'],
                    $row['duracao_filme'],
                    $categoria
                );
            }

            return $filmes;
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar filmes: " . $e->getMessage());
        }
    }

    public function create(Filme $filme): array
    {
        try {
            $this->conexao->beginTransaction();

            $stmt = $this->conexao->prepare(
                "INSERT INTO " . self::tableName . " (nome_filme, descricao_filme, duracao_filme, categoria_filme_id) 
                VALUES (:nome_filme, :descricao_filme, :duracao_filme, :categoria_filme_id)"
            );

            $stmt->bindValue(':nome_filme', $filme->get_nomeFilme(), PDO::PARAM_STR);
            $stmt->bindValue(':descricao_filme', $filme->get_descricaoFilme(), PDO::PARAM_STR);
            $stmt->bindValue(':duracao_filme', $filme->get_duracaoFilme(), PDO::PARAM_STR);
            $stmt->bindValue(':categoria_filme_id', $filme->get_categoriaFilmeId(), PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();
                return [
                    'success' => true,
                    'message' => 'Filme cadastrado com sucesso!',
                    'id' => $this->conexao->lastInsertId(),
                ];
            }

            $this->conexao->rollBack();
            return ['success' => false, 'message' => 'Falha ao cadastrar filme'];

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao cadastrar um filme: " . $e->getMessage());
        }
    }

    public function update(Filme $filme): array
    {
        try {
            $this->conexao->beginTransaction();

            if (!$filme->get_id()) {
                return ['success' => false, 'message' => 'O id é obrigatório para atualizar um filme'];
            }

            $stmt = $this->conexao->prepare(
                "UPDATE " . self::tableName . " 
                SET nome_filme = :nome_filme, descricao_filme = :descricao_filme, duracao_filme = :duracao_filme, categoria_filme_id = :categoria_filme_id 
                WHERE id = :id"
            );

            $stmt->bindValue(':id', $filme->get_id(), PDO::PARAM_INT);
            $stmt->bindValue(':nome_filme', $filme->get_nomeFilme(), PDO::PARAM_STR);
            $stmt->bindValue(':descricao_filme', $filme->get_descricaoFilme(), PDO::PARAM_STR);
            $stmt->bindValue(':duracao_filme', $filme->get_duracaoFilme(), PDO::PARAM_STR);
            $stmt->bindValue(':categoria_filme_id', $filme->get_categoriaFilmeId(), PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();
                return ['success' => true, 'message' => 'Filme atualizado com sucesso!'];
            }

            $this->conexao->rollBack();
            return ['success' => false, 'message' => 'Nenhuma alteração realizada.'];

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao atualizar o filme: " . $e->getMessage());
        }
    }

    public function delete(int $id): array
    {
        try {
            $this->conexao->beginTransaction();

            $stmt = $this->conexao->prepare('UPDATE ' . self::tableName . ' SET deleted_at = NOW() WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();
                return ['success' => true, 'message' => 'Filme deletado com sucesso!'];
            }

            $this->conexao->rollBack();
            return ['success' => false, 'message' => 'Filme não encontrado para exclusão.'];

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao deletar o filme: " . $e->getMessage());
        }
    }

    public function destroy(int $idFilme): array
    {
        try {
            $this->conexao->beginTransaction();

            $stmt = $this->conexao->prepare('DELETE FROM ' . self::tableName . ' WHERE id = :id');
            $stmt->bindValue(':id', $idFilme, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->conexao->commit();
                return ['success' => true, 'message' => 'Filme deletado permanentemente com sucesso!'];
            }

            $this->conexao->rollBack();
            return ['success' => false, 'message' => 'Filme não encontrado para exclusão definitiva.'];

        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new PDOException("ERRO ao deletar permanentemente o filme: " . $e->getMessage());
        }
    }
}
