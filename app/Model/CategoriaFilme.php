<?php

class CategoriaFilme {
    /**
     * @var int
     */
    private int $id;

    private ?string $nomeCategoria;

    /**
     * @param int    $id
     * @param string $nomeCategoria
     */
    public function __construct(int $id, string $nomeCategoria) {
        $this->id = $id;
        $this->nomeCategoria = $nomeCategoria;
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


    public function getNomeCategoria(): string
    {
        return $this->nomeCategoria;
    }

    /**
     * @param string $nomeCategoria
     *
     * @return void
     */
    public function setNomeCategoria(string $nomeCategoria): void
    {
        $this->nomeCategoria = $nomeCategoria;
    }

//    public function getCreated_at(): DateTime
//    {
//        return $this->created_at;
//    }
//    public function setCreated_at(DateTime $created_at): void {
//        $this->created_at = $created_at;
//    }

//    public function getUpdated_at(): DateTime {
//        return $this->updated_at;
//    }
//    public function setUpdated_at(DateTime $updated_at): void {
//        $this->updated_at = $updated_at;
//    }

//    public function getDeleted_at(): DateTime {
//        return $this->deleted_at;
//    }
//    public function setDeleted_at(DateTime $deleted_at): void {
//        $this->deleted_at = $deleted_at;
//    }

}