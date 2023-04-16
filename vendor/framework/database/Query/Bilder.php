<?

namespace vendor\framework\database\Query;

use vendor\log\LogWriter;

class Bilder
{
    protected $connection;
    protected $model;

    /**
     * Создаёт новый объект mysqli с параметроми из конфигураци.
     *
     * @param  string  $ip
     * @param  string  $name
     * @param  string  $password
     * @param  string  $login
     * @return true|false
     */
    public function __construct($model, string $ip = HOST, string $name = DB_NAME, string $password = PASS, string $login = USER)
    {
        $this->connection = $model->getConnection();
    }

    /**
     * Выполняет SQL запрос.
     *
     * @param  string  $request
     * @return array|false|true
     */
    private function execute_request(string $request)
    {
        if ($this->connection) {
            $data_table = explode('`', $request);
            $table = false;
            $result = mysqli_query($this->connection, $request);
            if (!$result) {
                $error = " -- ОШИБКА -- Запрос к таблице: '$data_table[1]' Ошибка: " . mysqli_error($this->connection);
                // $log = new LogWriter($error, "error");
                // unset($log);
                return [false];
            }
            if ($result === true || $request === false) {
                return $result;
            } 
            else if (@$result->num_rows == 0) {
                $error = " -- ОПОВЕЩЕНИЕ -- Запрос к таблице: '$data_table[1]'. Запрос '$request' вернул 0 строк";
                // $log = new LogWriter($error);
                unset($log);
                return false;
            } 
            else{
                $table = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
            return $table;
        }
    }

    public function insert_into()
    {
        $query = "INSERT INTO `articles`(`id`) VALUES ('[value-1]')";
        return $this->execute_request($query);
    }

    public function select(string $tableName, array $where = [],  array $columns)
    {
        $query = "SELECT "; 
        $strColumns = false;
        if($columns[0] != '*'){
            foreach($columns as $column){
                if(!$strColumns){
                    $strColumns = "`$column`";
                }
                else{
                    $strColumns .= ",`$column`";
                }
            }
        }
        else{
            $strColumns = $columns[0];
        }
        $query .= "$strColumns FROM `$tableName`";
        if($where){
            $query .= " WHERE ";
            foreach($where as $w){

            }
        }
        return $this->execute_request($query);
    }

    public function update()
    {
        $query = "UPDATE `articles` SET `id`='[value-1]' WHERE 1";
        return $this->execute_request($query);
    }

    public function delete()
    {
        $query = "DELETE FROM `articles` WHERE 0";
        return $this->execute_request($query);
    }
}
