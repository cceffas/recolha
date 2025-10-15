<?php

namespace App\database;

use Medoo\Medoo;

class Db
{


    private string $db_name = "saneamento_basico_municipal";
    private int $db_port = 33801;

    private string $host_name = "localhost";
    private string $password = "";
    private string $user_name = "root";
    private $connection;




    public function __construct()
    {


        $database = new Medoo([

            'type' => 'mysql',
            'database' => $this->db_name,
            'host' => $this->host_name,
            'username' => $this->user_name,
            'password' => $this->password,

            'charset' => 'utf8mb4',
            'port' => $this->db_port

        ]);


        $this->connection = $database;
    }


    public function getConnection()
    {

        return $this->connection;
    }



    public static function getTable($name): array
    {

        $resp = [];
        $result = null;

        $db = new Db();
        $db = $db->getConnection();
        $result = $db->select($name, "*");

        if ($result) {

            foreach ($result as $item) {

                $array = ["text" => $item['nome'], "value" => $item['id']];
                $resp[] = $array;
            }
        }

        return $resp;
    }
    public static function idName(string $table, string $id): string
    {


        $out = "vazio";

        $db = new Db();
        $db = $db->getConnection();

        $result = $db->get($table, 'nome', ['id' => $id]);
        if ($result) {

            $out = $result;
        }

        return $out;
    }
}
