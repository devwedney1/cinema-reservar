<?php 

class Sala {
    private int $id;
    private string $nomeSala;

    public function __construct(int $id, string $nomeSala) {
        $this->id = $id;
        $this->nomeSala = $nomeSala;
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

    /**
     * @return string
     */
    public function getNomeSala(): string
    {
        return $this->nomeSala;
    }

    /**
     * @param string $nomeSala
     *
     * @return void
     */
    public function setNomeSala(string $nomeSala): void
    {
        $this->nomeSala = $nomeSala;
    }

//    /**
//     * @return DateTime
//     */
//    public function getCreated_at(): DateTime
//    {
//        return $this->created_at;
//    }
//
//    /**
//     * @param DateTime $created_at
//     *
//     * @return void
//     */
//    public function setCreated_at(DateTime $created_at): void
//    {
//        $this->created_at = $created_at;
//    }
//
//    /**
//     * @return DateTime
//     */
//    public function getUpdated_at(): DateTime
//    {
//        return $this->updated_at;
//    }
//
//    /**
//     * @param DateTime $updated_at
//     *
//     * @return void
//     */
//    public function setUpdated_at(DateTime $updated_at): void
//    {
//        $this->updated_at = $updated_at;
//    }
//
//    /**
//     * @return DateTime
//     */
//    public function getDeleted_at(): DateTime
//    {
//        return $this->deleted_at;
//    }
//
//    /**
//     * @param DateTime $deleted_at
//     *
//     * @return void
//     */
//    public function setDeleted_at(DateTime $deleted_at): void
//    {
//        $this->deleted_at = $deleted_at;
//    }
}