<?php

class Sessao {
    /**
     * @var int
     */
    private int $id;
    /**
     * @var Filme
     */
    private Filme $filme_id;
    /**
     * @var Sala
     */
    private Sala $sala_id;

    public function __construct($id, $filme_id, $sala_id) {
        $this->id = $id;
        $this->filme_id = $filme_id;
        $this->sala_id = $sala_id;
    }

    /**
     * @return int
     */
    public function get_id(): int {
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
//
//    public function get_filme_id(): Filme {
//        return $this->filme_id;
//    }
//    public function set_filme_id(Filme $filme_id): void {
//        $this->filme_id = $filme_id;
//    }
//
//    public function get_sala_id(): Sala {
//        return $this->sala_id;
//    }
//    public function set_sala_id(Sala $sala_id): void {
//        $this->sala_id = $sala_id;
//    }
//
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