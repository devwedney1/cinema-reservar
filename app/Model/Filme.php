<?php

Class Filme
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var Categoria_filme
     */
    private Categoria_filme $categoria_filme_id;
    /**
     * @var string
     */
    private string $nomeFilme;
    /**
     * @var string
     */
    private string $descricaoFilme;
    private $duracaoFilme;

    /**
     * @param $nomeFilme
     * @param $descricaoFilme
     * @param $duracaoFilme
     */
    public function __construct($id, $categoria_filme_id, $nomeFilme, $descricaoFilme, $duracaoFilme){
        $this->id = $id;
        $this->categoria_filme_id = $categoria_filme_id;
        $this->nomeFilme = $nomeFilme;
        $this->descricaoFilme = $descricaoFilme;
        $this->duracaoFilme = $duracaoFilme;
    }

    /**
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return void
     */
    public function setId($id){
        $this->id = $id;
    }

       /**
     * @return Categoria_filme
     */
    public function getCategoria_filme_id(){
        return $this->categoria_filme_id;
    }
       /**
     * @return Categoria_filme
     */
    public function setCategoria_filme_id(Categoria_filme $categoria_filme_id){
        $this->categoria_filme_id = $categoria_filme_id;
    }

    /**
     * @return string
     */
    public function getNomeFilme(){
        return $this->nomeFilme;
    }

    /**
     * @param $nomeFilme
     *
     * @return void
     */
    public function setNomeFilme($nomeFilme){
        $this->nomeFilme = $nomeFilme;
    }

    /**
     * @return string
     */
    public function getDescricaoFilme(){
        return $this->descricaoFilme;
    }

    /**
     * @param $descricaoFilme
     *
     * @return void
     */
    public function setDescricaoFilme($descricaoFilme){
        $this->descricaoFilme = $descricaoFilme;
    }

    public function getDuracaoFilme(){
        return $this->duracaoFilme;
    }

    public function setDuracaoFilme($duracaoFilme){
        $this->duracaoFilme = $duracaoFilme;
    }
}