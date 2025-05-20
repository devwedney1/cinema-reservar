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

//    public function getSessao_id(): Sessao {
//        return $this->sessao_id;
//    }
//    public function setSessao_id(Sessao $sessao_id): void {
//        $this->sessao_id = $sessao_id;
//    }
//
//    public function getCadeira_id(): Cadeira {
//        return $this->cadeira_id;
//    }
//    public function setCadeira_id(Cadeira $cadeira_id): void {
//        $this->cadeira_id = $cadeira_id;
//    }
//
//    public function getForma_pagamento_id(): Forma_pagamento {
//        return $this->forma_pagamento_id;
//    }
//    public function setForma_pagamento_id(Forma_pagamento $forma_pagamento_id): void {
//        $this->forma_pagamento_id = $forma_pagamento_id;
//    }

    /**
     * @return float
     */
    public function getPreco(): float
    {
        return $this->preco;
    }

    /**
     * @param float $preco
     *
     * @return void
     */
    public function setPreco(float $preco): void
    {
        $this->preco = $preco;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return void
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

//    public function getVendido_em(): DateTime {
//        return $this->vendido_em;
//    }
//    public function setVendido_em(DateTime $vendido_em): void {
//        $this->vendido_em = $vendido_em;
//    }
}