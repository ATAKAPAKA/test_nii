<?

namespace vendor\framework\database;

use Exception;
use mysqli;

class Bilder
{
    protected object $model;
    protected object $connection;
    protected string $query = "";
    protected string $primaryKey = "id";
    private array $replaceSql = [
        "'",
        "select",
        "union",
        "`",
        "where",
        "join",
        "INSERT",
        "delete",
        "UPDATE",
        "GRANT",
        "REVOKE",
        "DROP",
        "CREATE",
        "ALTER",
        "from",
        "GROUP BY",
        "HAVING",
        "COMMIT"
    ];
    protected array $arrayQuery = [
        "select" => "",
        "update" => "",
        "insert" => "",
        "remove" => "",
        "where" => "",
        "join" => "",
        "limit" => "",
        "order_by" => ""
    ];
    protected array $operators = [
        '=',
        '<',
        '>',
        '<=',
        '>=',
        '<>'
    ];
    protected array $table = [];

    public function __construct($model)
    {
        $this->model = $model;
        $connection = new mysqli(HOST, USER, PASS, DB_NAME);
        $this->connection = $connection;
    }

    private function executeRequest($query)
    {
        $request_result = [];
        if ($query) {
            mysqli_set_charset($this->connection, "utf8");
            $request_result = $this->connection->query($query);
            if (!$request_result) {
                if (@$this->connection->error_list[0]["errno"] == 1146 && $this->model->getCreate() === true) {
                    $this->createTable();
                    $request_result = $this->executeRequest($query);
                }
            } else {
                if ($request_result === true) {
                    return true;
                }
                if (@$this->connection->num_rows !== 0) {
                    $this->table = $request_result->fetch_all(MYSQLI_ASSOC);
                } else if (@$this->connection->num_rows == 0) {
                    return true;
                }
            }
        }
    }


    protected function constructRequest(): string
    {
        $query = "";
        $canWhere = true;
        foreach ($this->arrayQuery as $key => $value) {
            if ($value != "") {
                if ($key == "select") {
                    $query = "SELECT $value FROM `{$this->model->getTableName()}`";
                    $canWhere = true;
                } else if ($key == "update") {
                    $query = "UPDATE `{$this->model->getTableName()}` SET $value";
                } else if ($key == "insert") {
                    $query = "INSERT INTO `{$this->model->getTableName()}` $value";
                    // $canWhere = true;
                } else if ($key == "remove") {
                    $query = "DELETE FROM `{$this->model->getTableName()}`";
                    $canWhere = true;
                } else if ($key == "where") {
                    if (!$canWhere && $query == "") {
                        $query = "SELECT * FROM `{$this->model->getTableName()}` WHERE $value";
                    } else {
                        $query .= " WHERE $value";
                    }
                } else if ($key == "limit") {
                    $query .= "LIMIT $value";
                } else if ($key == "order_by") {
                    $query .= " ORDER BY $value";
                }
            }
        }
        return $query;
    }

    protected function createTable()
    {
        $colums = $this->model->getColums();
        $strCol = "";
        foreach ($colums as $key => $val) {
            if ($strCol == "") {
                $strCol .= "$key $val";
            } else {
                $strCol .= ", $key $val";
            }
        }
        $newQuery = "CREATE TABLE {$this->model->getTableName()}($strCol)";
        $r = $this->executeRequest($newQuery);
    }

    protected function clean_data($data)
    {
        foreach ($this->replaceSql as $value) {
            if (stripos($data, $value)) {
                return false;
            }
        }
        return false;
    }

    public function get(): array
    {
        $query = $this->constructRequest();
        // $result = $this->executeRequest($query);
        $this->executeRequest($query);
        if ($this->table) {
            return $this->table;
        }
        return [];
    }

    //ПОЛУЧЕНИЕ

    public function select(string ...$colums)
    {
        $str = "*";
        $arrayLanth = count($colums);
        if ($arrayLanth != 0) {
            for ($i = 0; $i < $arrayLanth; $i++) {
                if ($colums[$i] == "" || $colums[$i] == "*") {
                    unset($colums[$i]);
                } else if ($this->clean_data($colums[$i])) {
                    $colums[$i] = "`$colums[$i]`";
                } else {
                    $_SESSION["ERROR"] = "Введены не корректные значения";
                    //header("Location: $_SERVER[HTTP_REFERER]");
                }
            }
            if (count($colums) != 0) {
                $str = implode(",", $colums);
            }
        }
        $this->arrayQuery["select"] = $str;
        return $this;
    }

    //ОБНОВЛЕНИЕ

    public function update(array $values)
    {
        $str = "";
        foreach ($values as $key => $value) {
            if ($str == "") {
                $str .= "`$key` = '$value'";
            } else {
                $str .= ", `$key` = '$value'";
            }
        }
        $this->arrayQuery["update"] = $str;
        return $this;
    }

    //ДОБАВЛЕНИЕ

    public function insert(array $values)
    {
        $str = "";
        $keys = [];
        $vals = [];
        foreach ($values as $key => $value) {
            array_push($keys, "`$key`");
            array_push($vals, "'$value'");
        }
        $this->arrayQuery["insert"] = '(' . implode(',', $keys) . ') VALUES (' . implode(',', $vals) . ')';
        $r = $this->constructRequest();
        $t = $this->executeRequest($r);
    }

    //УДАЛЕНИЕ

    public function remove()
    {
        $this->arrayQuery["remove"] = 1;
        $this->arrayQuery["where"] = 1;
        return $this;
    }

    //УСЛОВИЕ WHERE

    public function where(string $colum, $value, string $operator = '=')
    {
        $this->arrayQuery["where"] = "`$colum` $operator '$value'";
        return $this;
    }

    public function orWhere(string $table, $value, string $operator = '=')
    {
        if ($this->arrayQuery["where"] != "") {
            $this->arrayQuery["where"] .= " OR `$table` $operator '$value'";
        } else {
            throw new Exception("Сначала должна быть вызвана функция where()!");
        }
        return $this;
    }

    public function andWhere(string $table, $value, string $operator = '=')
    {
        if ($this->arrayQuery["where"] != "") {
            $this->arrayQuery["where"] .= " AND `$table` $operator '$value'";
        } else {
            throw new Exception("Сначала должна быть вызвана функция where()!");
        }
        return $this;
    }

    //ИНКАПСУЛИРОВАННЫЕ МЕТОДЫ

    public function find($id, array $colums = ["*"])
    {
        $strColums = "";
        foreach ($colums as $colum) {
            if ($strColums == "") {
                $strColums = $colum;
            } else {
                $strColums .= "$colum";
            }
        }
        $result = $this->select($strColums)->where($this->primaryKey, $id)->get();
        if ($result) {
            return $result[0];
        }
        return [];
    }

    public function all(array $colums = ["*"]): array
    {
        return $this->select(...$colums)->get();
    }

    public function orderBy(string $colum, string $asc_deck = "ASC")
    {
        $this->arrayQuery["order_by"] = "`$colum` $asc_deck";
        return $this;
    }

    public function raw(string $reqest)
    {
        $this->executeRequest($reqest);
        return $this;
    }

    public function join()
    {
    }

    public function leftJoin()
    {
    }
}
