<?php


namespace App\models;

use App\database\Db;

class Models
{



    public static function all()
    {


        $name_table = self::class;



        return $name_table;

        $db = new Db();
        $db = $db->getConnection();

        return $db->select($name_table, '*');
    }
}
