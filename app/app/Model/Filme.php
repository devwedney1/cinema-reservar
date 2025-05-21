<?php

require_once '../Model/CategoriaFilme.php';

class Filme
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $nomeFilme;
    /**
     * @var string
     */
    private string $descricaoFilme;
    /**
     * @var string
     */
    private string $duracaoFilme;
    /**
     * @var int
     */
    private int $categoriaFilmeId;

    /**
     * @var CategoriaFilme
     */
    private CategoriaFilme $categoriaFilme;
    /**
     * @var string|null
     */
    private ?string $created_at;
    /**
     * @var string|null
     */
    private ?string $updated_at;
    /**
     * @var string|null
     */
    private ?string $deleted_at;

    /**
     * @param int            $id
     * @param string         $nome
     * @param string         $descricao
     * @param string         $duracao
     * @param int            $categoriaId
     * @param CategoriaFilme $categoriaFilme
     */
    public function __construct(
        int $id,
        string $nome,
        string $descricao,
        string $duracao,
        int $categoriaId,
        CategoriaFilme $categoriaFilme
    ) {
        $this->id = $id;
        $this->nomeFilme = $nome;
        $this->descricaoFilme = $descricao;
        $this->duracaoFilme = $duracao;
        $this->categoriaFilmeId = $categoriaId;
        $this->categoriaFilme = $categoriaFilme;
    }

    /**
     * @return int
     */
    public function get_id(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function set_id(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function get_nomeFilme(): string
    {
        return $this->nomeFilme;
    }

    /**
     * @param string $nome
     *
     * @return void
     */
    public function set_nomeFilme(string $nome): void
    {
        $this->nomeFilme = $nome;
    }

    /**
     * @return string
     */
    public function get_descricaoFilme(): string
    {
        return $this->descricaoFilme;
    }

    /**
     * @param string $descricao
     *
     * @return void
     */
    public function set_descricaoFilme(string $descricao): void
    {
        $this->descricaoFilme = $descricao;
    }

    /**
     * @return string
     */
    public function get_duracaoFilme(): string
    {
        return $this->duracaoFilme;
    }

    /**
     * @param string $duracao
     *
     * @return void
     */
    public function set_duracaoFilme(string $duracao): void
    {
        $this->duracaoFilme = $duracao;
    }

    /**
     * @return string
     */
    public function get_categoriaFilme(): string
    {
        return $this->categoriaFilme->get_nomeCategoria();
    }

    /**
     * @return int
     */
    public function get_categoriaFilmeId(): int
    {
        return $this->categoriaFilme->get_id();
    }

    /**
     * @param int $categoriaId
     *
     * @return void
     */
    public function set_categoriaFilmeId(int $categoriaId): void
    {
        $this->categoriaFilmeId = $categoriaId;
    }

    /**
     * @return string|null
     */
    public function get_createdAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * @param string|null $createdAt
     *
     * @return void
     */
    public function set_createdAt(?string $createdAt): void
    {
        $this->created_at = $createdAt;
    }

    /**
     * @return string|null
     */
    public function get_updatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * @param string|null $updatedAt
     *
     * @return void
     */
    public function set_updatedAt(?string $updatedAt): void
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * @return string|null
     */
    public function get_deletedAt(): ?string
    {
        return $this->deleted_at;
    }

    /**
     * @param string|null $deletedAt
     *
     * @return void
     */
    public function set_deletedAt(?string $deletedAt): void
    {
        $this->deleted_at = $deletedAt;
    }
}
