<?php 

class Forma_pagamento {
    private int $id;
    
    private string $pagamento;

    private DateTime $created_at;
    private DateTime $updated_at;
    private DateTime $deleted_at;

    public function __construct($id, $pagamento, $created_at, $updated_at, $deleted_at) {
        $this->id = $id;
        $this->pagamento = $pagamento;
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

    public function getPagamento(): string {
        return $this->pagamento;
    }
    public function setPagamento(string $pagamento): void {
        $this->pagamento = $pagamento;
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
    public function setDeleted_at(DateTime $deleted_at) {
        $this->deleted_at = $deleted_at;
    }
}