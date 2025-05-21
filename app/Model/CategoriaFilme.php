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


    public function get_nomeCategoria(): string
    {
        return $this->nomeCategoria;
    }

    /**
     * @param string $nomeCategoria
     *
     * @return void
     */
    public function set_nomeCategoria(string $nomeCategoria): void
    {
        $this->nomeCategoria = $nomeCategoria;
    }

//    public function get_created_at(): DateTime
//    {
//        return $this->created_at;
//    }
//    public function set_created_at(DateTime $created_at): void {
//        $this->created_at = $created_at;
//    }

//    public function get_updated_at(): DateTime {
//        return $this->updated_at;
//    }
//    public function set_updated_at(DateTime $updated_at): void {
//        $this->updated_at = $updated_at;
//    }

//    public function get_deleted_at(): DateTime {
//        return $this->deleted_at;
//    }
//    public function set_deleted_at(DateTime $deleted_at): void {
//        $this->deleted_at = $deleted_at;
//    }

}