<?php
require_once '../Dao/FilmeDAO.php';
require_once '../Model/Filme.php';
require_once '../Model/CategoriaFilme.php';

class FilmeController {

    /**
     * @var FilmeDAO
     */
    protected FilmeDAO $filmeDAO;

    /**
     * @var Filme
     */
    protected Filme $filme;

    /**
     * @var CategoriaFilme
     */
    protected CategoriaFilme $categoriaFilme;


    /**
     * @param FilmeDAO       $filmeDAO
     * @param Filme          $filme
     * @param CategoriaFilme $categoriaFilme
     */
    public function __construct(FilmeDAO $filmeDAO, Filme $filme, CategoriaFilme $categoriaFilme) {
        $this->filmeDAO = $filmeDAO;
        $this->filme = $filme;
        $this->categoriaFilme = $categoriaFilme;
    }

    /**
     * @return array
     */
    public function indexFilme(): array
    {
        return $this->filmeDAO->get();
    }

    /**
     * @return array|null
     */
    public function createFilme()
    {

        $nome = $_POST['nome_filme'];
        $descricao = $_POST['descricao_filme'];
        $duracao = $_POST['duracao_filme'];

        $this->filme->setNomeFilme($nome);
        $this->filme->setDescricaoFilme($descricao);
        $this->filme->setDuracaoFilme($duracao);

        $resultado = $this->filmeDAO->create($this->filme);

        return $resultado;
    }

    /**
     * @return array|null
     */
    public function updateFilme()
    {
        $id = $_POST['id'];
        $nome = $_POST['nome_filme'];
        $descricao = $_POST['descricao_filme'];
        $duracao = $_POST['duracao_filme'];

        $this->filme->setId($id);
        $this->filme->setNomeFilme($nome);
        $this->filme->setDescricaoFilme($descricao);
        $this->filme->setDuracaoFilme($duracao);

        $resultado = $this->filmeDAO->update($this->filme);

        return $resultado;
    }

    /**
     * @return array|null
     */
    public function deleteFilme() {

        $id = $_POST['id'];

        $this->filme->setId($id);

        $resultado = $this->filmeDAO->delete($this->filme);

        return $resultado;
    }

    public function forceDeleteFilme()
    {

    }
}