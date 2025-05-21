<?php

class Horario_sessao {
    /**
     * @var int
     */
    private int $id;
    /**
     * @var DateTime
     */
    private DateTime $tempoSessoes;

    /**
     * @param int      $id
     * @param DateTime $tempoSessoes
     */
    public function __construct(int $id, DateTime $tempoSessoes) {
        $this->id = $id;
        $this->tempoSessoes = $tempoSessoes;

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

//    public function get_sessoesFilmes_id(): Sessao
//    {
//        return $this->sessoes_filmes_id;
//    }
//    public function set_sessoes_filmes_id(Sessao $sessoes_filmes_id): void {
//        $this->sessoes_filmes_id = $sessoes_filmes_id;
//    }

    /**
     * @return DateTime
     */
    public function get_tempoSessoes(): DateTime
    {
        return $this->tempoSessoes;
    }

    /**
     * @param DateTime $tempoSessoes
     *
     * @return void
     */
    public function set_tempo_sessoes(DateTime $tempoSessoes): void
    {
        $this->tempoSessoes = $tempoSessoes;
    }

//    public function get_created_at(): DateTime {
//        return $this->created_at;
//    }
//    public function set_created_at(DateTime $created_at): void {
//        $this->created_at = $created_at;
//    }
//
//    public function get_updated_at(): DateTime {
//        return $this->updated_at;
//    }
//    public function set_updated_at(DateTime $updated_at): void {
//        $this->updated_at = $updated_at;
//    }
//
//    public function get_deleted_at(): DateTime {
//        return $this->deleted_at;
//    }
//    public function set_deleted_at(DateTime $deleted_at): void {
//        $this->deleted_at = $deleted_at;
//    }
}