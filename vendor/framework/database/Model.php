<?php

namespace vendor\framework\database;


abstract class Model
{
    protected string $tableName;
    protected string $primaryKey = 'id';
    protected bool $autoIncriment = true;
    protected array $fillable = [];
    protected array $guarded = ['*'];
    protected array $colums = [];
    protected bool $canCreate = false;

    public function __construct(string $ip = HOST, string $name = DB_NAME, string $password = PASS, string $login = USER)
    {
        $this->tableName = strtolower(str_replace("core\models\\", '', $this::class));
        return $this;
    }

    public static function __callStatic($method, $parameters)//: Bilder|array
    {
        $model = new static;
        $r = new Bilder($model);
        $r = $r->$method(...$parameters);
        return $r;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function getCreate()
    {
        return $this->canCreate;
    }

    public function getColums()
    {
        return $this->colums;
    }
}
