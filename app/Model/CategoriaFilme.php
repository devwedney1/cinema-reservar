<?php

class CategoriaFilme
{
    private ?int $id;
    private string $nomeCategoria;

    public function __construct(?int $id, string $nomeCategoria)
    {
        $this->id = $id;
        $this->nomeCategoria = $nomeCategoria;
    }

    public function get_id(): ?int
    {
        return $this->id;
    }

    public function set_id(int $id): void
    {
        $this->id = $id;
    }

    public function get_nomeCategoria(): string
    {
        return $this->nomeCategoria;
    }

    public function set_nomeCategoria(string $nomeCategoria): void
    {
        $this->nomeCategoria = $nomeCategoria;
    }
}
