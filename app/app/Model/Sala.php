<?php

class Sala
{
    private int $id;
    private string $nome_sala;

    public function get_id(): int
    {
        return $this->id;
    }

    public function set_id(int $id): void
    {
        $this->id = $id;
    }

    public function get_nomeSala(): string
    {
        return $this->nome_sala;
    }

    public function set_nomeSala(string $nome_sala): void
    {
        $this->nome_sala = $nome_sala;
    }
}
