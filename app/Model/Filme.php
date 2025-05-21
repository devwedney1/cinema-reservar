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
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNomeFilme(): string
    {
        return $this->nomeFilme;
    }

    /**
     * @param string $nome
     *
     * @return void
     */
    public function setNomeFilme(string $nome): void
    {
        $this->nomeFilme = $nome;
    }

    /**
     * @return string
     */
    public function getDescricaoFilme(): string
    {
        return $this->descricaoFilme;
    }

    /**
     * @param string $descricao
     *
     * @return void
     */
    public function setDescricaoFilme(string $descricao): void
    {
        $this->descricaoFilme = $descricao;
    }

    /**
     * @return string
     */
    public function getDuracaoFilme(): string
    {
        return $this->duracaoFilme;
    }

    /**
     * @param string $duracao
     *
     * @return void
     */
    public function setDuracaoFilme(string $duracao): void
    {
        $this->duracaoFilme = $duracao;
    }

    /**
     * @return string
     */
    public function getCategoriaFilme(): string
    {
        return $this->categoriaFilme->getNomeCategoria();
    }

    /**
     * @return int
     */
    public function getCategoriaFilmeId(): int
    {
        return $this->categoriaFilmeId;
    }

    /**
     * @param int $categoriaId
     *
     * @return void
     */
    public function setCategoriaFilmeId(int $categoriaId): void
    {
        $this->categoriaFilmeId = $categoriaId;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * @param string|null $createdAt
     *
     * @return void
     */
    public function setCreatedAt(?string $createdAt): void
    {
        $this->created_at = $createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * @param string|null $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * @return string|null
     */
    public function getDeletedAt(): ?string
    {
        return $this->deleted_at;
    }

    /**
     * @param string|null $deletedAt
     *
     * @return void
     */
    public function setDeletedAt(?string $deletedAt): void
    {
        $this->deleted_at = $deletedAt;
    }
}
