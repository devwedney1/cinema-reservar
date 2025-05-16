<?php

class DataConnection
{
    private static $instance;

    /**
     * @return PDO|void
     */
    public static function getConnection ()
    {
        try {
            if (!isset(self::$instance)) {

                $database = self::dataToConnection();
                self::$instance = new PDO("mysql:host={$database['hots']};dbname={$database['dbname']};charset=utf8", $database['user'], $database['password']);

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            return self::$instance;
        } catch (PDOException $e) {
            echo "Erro na conexão: {$e->getMessage()}";
        }
    }

    /**
     * @return array|void
     */
    private static function dataToConnection ()
    {
        try {

            $configDataBase = require_once '../Config/database.php';

            return [
                'host' => $configDataBase['hots'],
                'dbname' => $configDataBase['dbname'],
                'user' => $configDataBase['user'],
                'password' => $configDataBase['password'],
            ];

        } catch (Exception $e) {
            echo " Erro no carregamento do dados para conexão do banco de dados: {$e->getMessage()}";
        }
    }
}