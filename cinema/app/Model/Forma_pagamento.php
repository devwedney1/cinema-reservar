<?php 

class Forma_pagamento {
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $pagamento;

    public function __construct($id, $pagamento) {
        $this->id = $id;
        $this->pagamento = $pagamento;
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

    /**
     * @return string
     */
    public function get_pagamento(): string
    {
        return $this->pagamento;
    }

    /**
     * @param string $pagamento
     *
     * @return void
     */
    public function set_pagamento(string $pagamento): void
    {
        $this->pagamento = $pagamento;
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
//    public function set_deleted_at(DateTime $deleted_at) {
//        $this->deleted_at = $deleted_at;
//    }
}