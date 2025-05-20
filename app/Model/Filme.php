<?php

require_once 'CategoriaFilme.php';

Class Filme
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var CategoriaFilme
     */
    private CategoriaFilme $categoriaFilme;
    /**
     * @var string
     */
    private string $nomeFilme;
    /**
     * @var string
     */
    private string $descricaoFilme;
    /**
     * @var DateTime
     */
    private DateTime $duracaoFilme;

    /**
     * @param int            $id
     * @param CategoriaFilme $categoriaFilme
     * @param string         $nomeFilme
     * @param string         $descricaoFilme
     * @param DateTime       $duracaoFilme
     */
    public function __construct(int $id, CategoriaFilme $categoriaFilme, string $nomeFilme, string $descricaoFilme, DateTime $duracaoFilme){
        $this->id = $id;
        $this->categoriaFilme = $categoriaFilme;
        $this->nomeFilme = $nomeFilme;
        $this->descricaoFilme = $descricaoFilme;
        $this->duracaoFilme = $duracaoFilme;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return void
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

//    /**
//     * @return int
//     */
//    public function getCategoriaFilmeId(): int
//    {
//        return $this->categoriaFilme->getId();
//    }
//
//    public function setCategoriaFilmeId(CategoriaFilme $categoriaFilme): void
//    {
//        $this->categoriaFilme = $categoriaFilme->getId();
//    }

    /**
     * @return string
     */
    public function getNomeFilme(): string
    {
        return $this->nomeFilme;
    }

    /**
     * @param $nomeFilme
     *
     * @return void
     */
    public function setNomeFilme($nomeFilme): void
    {
        $this->nomeFilme = $nomeFilme;
    }

    /**
     * @return string
     */
    public function getDescricaoFilme(): string
    {
        return $this->descricaoFilme;
    }

    /**
     * @param $descricaoFilme
     *
     * @return void
     */
    public function setDescricaoFilme($descricaoFilme): void
    {
        $this->descricaoFilme = $descricaoFilme;
    }

    /**
     * @return DateTime
     */
    public function getDuracaoFilme(): DateTime
    {
        return $this->duracaoFilme;
    }

    /**
     * @param $duracaoFilme
     *
     * @return void
     */
    public function setDuracaoFilme($duracaoFilme): void
    {
        $this->duracaoFilme = $duracaoFilme;
    }
}