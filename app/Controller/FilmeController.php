<?php

require_once '../Dao/FilmeDAO.php';
require_once '../Model/Filme.php';
require_once '../Model/CategoriaFilme.php';

class FilmeController
{
    private FilmeDAO $filmeDAO;

    public function __construct(FilmeDAO $filmeDAO)
    {
        $this->filmeDAO = $filmeDAO;
    }

    /**
     * Lista todos os filmes
     *
     * @return Filme[]
     */
    public function indexFilme(): array
    {
        return $this->filmeDAO->get();
    }

    /**
     * Cria um novo filme
     *
     * @param array $data
     * @return bool
     */
    public function createFilme(array $data): bool
    {
        $categoriaFilme = new CategoriaFilme(
            (int) $data['categoria_filme_id'],
            '' // você pode buscar o nome da categoria aqui, se precisar
        );

        $filme = new Filme(
            null,
            $data['nome_filme'],
            $data['descricao_filme'],
            $data['duracao_filme'],
            $categoriaFilme
        );

        return $this->filmeDAO->create($filme);
    }

    /**
     * Atualiza um filme existente
     *
     * @param array $data
     * @return bool
     */
    public function updateFilme(array $data): bool
    {
        $categoriaFilme = new CategoriaFilme(
            (int) $data['categoria_filme_id'],
            ''
        );

        $filme = new Filme(
            (int) $data['id'],
            $data['nome_filme'],
            $data['descricao_filme'],
            $data['duracao_filme'],
            $categoriaFilme
        );

        return $this->filmeDAO->update($filme);
    }

    /**
     * Deleta um filme (soft delete)
     *
     * @param int $id
     * @return bool
     */
    public function deleteFilme(int $id): bool
    {
        $filme = new Filme($id, '', '', '', new CategoriaFilme(null, ''));

        return $this->filmeDAO->delete($filme);
    }

    /**
     * Deleta um filme de forma permanente
     *
     * @param int $id
     * @return bool
     */
    public function forceDeleteFilme(int $id): bool
    {
        return $this->filmeDAO->destroy($id);
    }
}
