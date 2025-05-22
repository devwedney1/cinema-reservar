<?php

require_once '../Model/CategoriaFilme.php';

class Filme
{
    private ?int $id;
    private string $nomeFilme;
    private string $descricaoFilme;
    private string $duracaoFilme;
    private CategoriaFilme $categoriaFilme;
    private ?string $created_at;
    private ?string $updated_at;
    private ?string $deleted_at;

    public function __construct(
        ?int $id,
        string $nome,
        string $descricao,
        string $duracao,
        CategoriaFilme $categoriaFilme
    ) {
        $this->id = $id;
        $this->nomeFilme = $nome;
        $this->descricaoFilme = $descricao;
        $this->duracaoFilme = $duracao;
        $this->categoriaFilme = $categoriaFilme;
    }

    public function get_id(): ?int
    {
        return $this->id;
    }

    public function set_id(int $id): void
    {
        $this->id = $id;
    }

    public function get_nomeFilme(): string
    {
        return $this->nomeFilme;
    }

    public function set_nomeFilme(string $nome): void
    {
        $this->nomeFilme = $nome;
    }

    public function get_descricaoFilme(): string
    {
        return $this->descricaoFilme;
    }

    public function set_descricaoFilme(string $descricao): void
    {
        $this->descricaoFilme = $descricao;
    }

    public function get_duracaoFilme(): string
    {
        return $this->duracaoFilme;
    }

    public function set_duracaoFilme(string $duracao): void
    {
        $this->duracaoFilme = $duracao;
    }

    public function get_categoriaFilmeId(): CategoriaFilme
    {
        return $this->categoriaFilme;
    }

    public function get_categoriaFilme(): CategoriaFilme
    {
        return $this->categoriaFilme;
    }

    public function set_categoriaFilme(CategoriaFilme $categoriaFilme): void
    {
        $this->categoriaFilme = $categoriaFilme;
    }

    public function get_createdAt(): ?string
    {
        return $this->created_at;
    }

    public function set_createdAt(?string $createdAt): void
    {
        $this->created_at = $createdAt;
    }

    public function get_updatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function set_updatedAt(?string $updatedAt): void
    {
        $this->updated_at = $updatedAt;
    }

    public function get_deletedAt(): ?string
    {
        return $this->deleted_at;
    }

    public function set_deletedAt(?string $deletedAt): void
    {
        $this->deleted_at = $deletedAt;
    }
}
