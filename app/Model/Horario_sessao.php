<?php

class Horario_sessao {
    private int $id;
    private Sessao $sessoes_filmes_id;

    private DateTime $tempo_sessoes;

    private DateTime $created_at;
    private DateTime $updated_at;
    private DateTime $deleted_at;

    public function __construct($id, $sessoes_filmes_id, $tempo_sessoes, $created_at, $updated_at, $deleted_at) {
        $this->id = $id;
        $this->sessoes_filmes_id = $sessoes_filmes_id;
        $this->tempo_sessoes = $tempo_sessoes;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;        
    }

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getSessoes_filmes_id(): Sessao {
        return $this->sessoes_filmes_id;
    }
    public function setSessoes_filmes_id(Sessao $sessoes_filmes_id): void {
        $this->sessoes_filmes_id = $sessoes_filmes_id;
    }

    public function getTempo_sessoes(): DateTime {
        return $this->tempo_sessoes;
    }
    public function setTempo_sessoes(DateTime $tempo_sessoes): void {
        $this->tempo_sessoes = $tempo_sessoes;
    }

    public function getCreated_at(): DateTime {
        return $this->created_at;
    }
    public function setCreated_at(DateTime $created_at): void {
        $this->created_at = $created_at;
    }

    public function getUpdated_at(): DateTime {
        return $this->updated_at;
    }
    public function setUpdated_at(DateTime $updated_at): void {
        $this->updated_at = $updated_at;
    }

    public function getDeleted_at(): DateTime {
        return $this->deleted_at;
    }
    public function setDeleted_at(DateTime $deleted_at): void {
        $this->deleted_at = $deleted_at;
    }
}