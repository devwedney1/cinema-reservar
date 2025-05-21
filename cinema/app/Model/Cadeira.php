<?php

require_once __DIR__ . '/Sala.php';

class Cadeira
{
    private int $id;
    private Sala $sala;
    private int $numero_cadeira;

    public function get_id(): int
    {
        return $this->id;
    }

    public function set_id(int $id): void
    {
        $this->id = $id;
    }

    public function get_sala(): Sala
    {
        return $this->sala;
    }

    public function set_sala(Sala $sala): void
    {
        $this->sala = $sala;
    }

    public function get_numeroCadeira(): int
    {
        return $this->numero_cadeira;
    }

    public function set_numeroCadeira(int $numero_cadeira): void
    {
        $this->numero_cadeira = $numero_cadeira;
    }
}
