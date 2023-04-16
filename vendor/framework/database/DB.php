<?php

namespace vendor\framework\database;

class DB
{
    private static string $tableName;
    private static string $reqest;

    public static function table($tableName)
    {
        self::$tableName = $tableName;
    }

    
}
