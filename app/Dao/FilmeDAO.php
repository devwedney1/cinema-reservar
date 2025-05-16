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

    public function first(int $idfilme)
    {
        try {

            $query = "SELECT * FROM " . self::tableName . " where id = :idfilme LIMIT 1";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':idfilme', $idfilme, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new PDOException("ERRO ao buscar um filme" . $e->getMessage());
        }
    }


}