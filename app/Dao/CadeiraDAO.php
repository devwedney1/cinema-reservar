<?php

require_once __DIR__ . '/../Connection/DataConnection.php';
require_once __DIR__ . '/../Model/Cadeira.php';
require_once __DIR__ . '/../Model/Sala.php';

class CadeiraDAO
{
    public function get(): array
    {
        try {
            $con = DataConnection::get_connection();
            if (!$con) throw new Exception("Sem conexão com o banco.");

            $stmt = $con->query("SELECT * FROM cadeiras WHERE deleted_at IS NULL");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return ["erro" => $e->get_message()];
        }
    }

    public function get_bySala(Sala $sala): array
    {
        try {
            $con = DataConnection::get_connection();
            if (!$con) throw new Exception("Sem conexão com o banco.");

            $stmt = $con->prepare("SELECT * FROM cadeiras WHERE sala_id = :sala_id AND deleted_at IS NULL");
            $stmt->execute([':sala_id' => $sala->get_id()]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return ["erro" => $e->get_message()];
        }
    }

    public function create(Cadeira $cadeira): array
    {
        try {
            $con = DataConnection::get_connection();
            if (!$con) throw new Exception("Sem conexão com o banco.");

            $stmt = $con->prepare("INSERT INTO cadeiras (sala_id, numero_cadeira) VALUES (:sala_id, :numero_cadeira)");
            $stmt->execute([
                ':sala_id' => $cadeira->get_sala()->get_id(),
                ':numero_cadeira' => $cadeira->get_numeroCadeira()
            ]);
            return ["mensagem" => "Cadeira criada com sucesso."];
        } catch (Exception $e) {
            return ["erro" => $e->get_message()];
        }
    }

    public function update(Cadeira $cadeira): array
    {
        try {
            $con = DataConnection::get_connection();
            if (!$con) throw new Exception("Sem conexão com o banco.");

            $stmt = $con->prepare("UPDATE cadeiras SET numero_cadeira = :numero_cadeira WHERE id = :id");
            $stmt->execute([
                ':id' => $cadeira->get_id(),
                ':numero_cadeira' => $cadeira->get_numeroCadeira()
            ]);
            return ["mensagem" => "Cadeira atualizada com sucesso."];
        } catch (Exception $e) {
            return ["erro" => $e->get_message()];
        }
    }

    public function delete(Cadeira $cadeira): array
    {
        try {
            $con = DataConnection::get_connection();
            if (!$con) throw new Exception("Sem conexão com o banco.");

            $stmt = $con->prepare("UPDATE cadeiras SET deleted_at = NOW() WHERE id = :id");
            $stmt->execute([':id' => $cadeira->get_id()]);
            return ["mensagem" => "Cadeira excluída com sucesso."];
        } catch (Exception $e) {
            return ["erro" => $e->get_message()];
        }
    }
}
