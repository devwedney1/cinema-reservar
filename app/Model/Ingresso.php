<?php

class Ingresso {
    /**
     * @var int
     */
    private int $id;
    /**
     * @var float
     */
    private float $preco;
    protected string $status;

    /**
     * @param int    $id
     * @param float  $preco
     * @param string $status
     */
    public function __construct(int $id, float $preco, string $status) {
        $this->id = $id;
        $this->preco = $preco;
        $this->status = $status;
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

//    public function get_sessao_id(): Sessao {
//        return $this->sessao_id;
//    }
//    public function set_sessao_id(Sessao $sessao_id): void {
//        $this->sessao_id = $sessao_id;
//    }
//
//    public function get_cadeira_id(): Cadeira {
//        return $this->cadeira_id;
//    }
//    public function set_cadeira_id(Cadeira $cadeira_id): void {
//        $this->cadeira_id = $cadeira_id;
//    }
//
//    public function get_forma_pagamento_id(): Forma_pagamento {
//        return $this->forma_pagamento_id;
//    }
//    public function set_forma_pagamento_id(Forma_pagamento $forma_pagamento_id): void {
//        $this->forma_pagamento_id = $forma_pagamento_id;
//    }

    /**
     * @return float
     */
    public function get_preco(): float
    {
        return $this->preco;
    }

    /**
     * @param float $preco
     *
     * @return void
     */
    public function set_preco(float $preco): void
    {
        $this->preco = $preco;
    }

    /**
     * @return string
     */
    public function get_status(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return void
     */
    public function set_status(string $status): void
    {
        $this->status = $status;
    }

//    public function get_vendido_em(): DateTime {
//        return $this->vendido_em;
//    }
//    public function set_vendido_em(DateTime $vendido_em): void {
//        $this->vendido_em = $vendido_em;
//    }
}