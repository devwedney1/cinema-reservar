<?php

class Ingresso {
    private int $id;
    private Sessao $sessao_id;
    private Cadeira $cadeira_id;
    private Forma_pagamento $forma_pagamento_id;

    private float $preco; // ponto flutuante de dupla precisão 
    
    private string $status;
    private DateTime $vendido_em;

    public function __construct($id, $sessao_id, $cadeira_id, $forma_pagamento_id, $preco, $status, $vendido_em) {
        $this->id = $id;
        $this->sessao_id = $sessao_id;
        $this->cadeira_id = $cadeira_id;
        $this->forma_pagamento_id = $forma_pagamento_id;
        $this->preco = $preco;
        $this->status = $status;
        $this->vendido_em = $vendido_em;
    }

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void{
        $this->id = $id;
    }

    public function getSessao_id(): Sessao {
        return $this->sessao_id;
    }
    public function setSessao_id(Sessao $sessao_id): void {
        $this->sessao_id = $sessao_id;
    }

    public function getCadeira_id(): Cadeira {
        return $this->cadeira_id;
    }
    public function setCadeira_id(Cadeira $cadeira_id): void {
        $this->cadeira_id = $cadeira_id;
    }

    public function getForma_pagamento_id(): Forma_pagamento {
        return $this->forma_pagamento_id;
    }
    public function setForma_pagamento_id(Forma_pagamento $forma_pagamento_id): void {
        $this->forma_pagamento_id = $forma_pagamento_id;
    }

    public function getPreco(): float {
        return $this->preco;
    }
    public function setPreco(float $preco): void {
        $this->preco = $preco;
    }

    public function getStatus(): string {
        return $this->status;
    }
    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function getVendido_em(): DateTime {
        return $this->vendido_em;
    }
    public function setVendido_em(DateTime $vendido_em): void {
        $this->vendido_em = $vendido_em;
    }
}