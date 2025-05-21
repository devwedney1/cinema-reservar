<?php

Class CategoriaDAO
{
    private $conexao;
    private const table = 'categoria_filmes';

    public function __construct()
    {
        $this->conexao = DataConnection::get_connection();
    }

    /**
     * @return array
     */
    public function get(): array
    {
        $sql = "SELECT * FROM " . self::table;
        $stmt = $this->conexao->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categoriaFilme = [];

        foreach ($rows as $row) {
            $categoriaFilme[] = new CategoriaFilme($row['id'], $row['nome_categoria']);
        }

        return $categoriaFilme;

    }
}