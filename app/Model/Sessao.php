<?php

class Sessao {
    private int $id;
    private Filme $filme_id;
    private Sala $sala_id;

    private DateTime $created_at;
    private DateTime $updated_at;
    private DateTime $deleted_at;

    public function __construct($id, $filme_id, $sala_id, $created_at, $updated_at, $deleted_at) {
        $this->id = $id;
        $this->filme_id = $filme_id;
        $this->sala_id = $sala_id;
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

    public function getFilme_id(): Filme {
        return $this->filme_id;
    }
    public function setFilme_id(Filme $filme_id): void {
        $this->filme_id = $filme_id;
    }

    public function getSala_id(): Sala {
        return $this->sala_id;
    }
    public function setSala_id(Sala $sala_id): void {
        $this->sala_id = $sala_id;
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