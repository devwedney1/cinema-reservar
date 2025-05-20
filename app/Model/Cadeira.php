<?php

require_once 'Sala.php';

class Cadeira {
    /**
     * @var int
     */
    private int $id;
    /**
     * @var Sala
     */
    private Sala $sala;
    /**
     * @var int
     */
    private int $numeroCadeira;

    public function __construct(int $id, Sala $sala, int $numeroCadeira) {
        $this->id = $id;
        $this->sala = $sala;
        $this->numeroCadeira = $numeroCadeira;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

//    /**
//     * @return int
//     */
//    public function getSalaId(): int
//    {
//        return $this->salaId;
//    }
//
//    /**
//     * @param Sala $salaId
//     *
//     * @return void
//     */
//    public function setSalaId(Sala $salaId): void {
//        $this->salaId = $salaId;
//    }

    /**
     * @return int
     */
    public function getNumeroCadeira(): int
    {
        return $this->numeroCadeira;
    }

    /**
     * @param int $numeroCadeira
     *
     * @return void
     */
    public function setNumeroCadeira(int $numeroCadeira): void
    {
        $this->numeroCadeira = $numeroCadeira;
    }

//    public function getCreated_at(): DateTime {
//        return $this->created_at;
//    }
//    public function setCreated_at(DateTime $created_at): void {
//        $this->created_at = $created_at;
//    }
//
//    public function getUpdated_at(): DateTime {
//        return $this->updated_at;
//    }
//    public function setUpdated_at(DateTime $updated_at): void {
//        $this->updated_at = $updated_at;
//    }
//
//    public function getDeleted_at(): DateTime {
//        return $this->deleted_at;
//    }
//    public function setDeleted_at(DateTime $deleted_at): void {
//        $this->deleted_at = $deleted_at;
//    }
}