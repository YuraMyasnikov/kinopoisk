<?php

namespace App\Kernel\DataBase;

use App\Kernel\Config\ConfigInterface;
use App\Kernel\DataBase\DataBaseInterface;

class DataBase implements DataBaseInterface
{

    private \PDO $pdo;

    public function __construct(
        private ConfigInterface $config
    )
    {
        $this->connect();
    }

    public function insert(string $table, array $data): int|false
    {
        //dd($data);
        $fields = array_keys($data);
         //dd($fields);

        // INSERT INTO `movie` (name) VALUES (:name)
        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn($fields) => ":$fields", $fields));
        // dd($fields,$columns,$binds);

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";
        $stmt = $this->pdo->prepare($sql);
        //dd($data,$sql,$stmt);

        try{
            $stmt->execute($data);
        } catch (\PDOException $exception )
        {
            dump('execute error insert', $exception);
            return false;
        }

        return (int) $this->pdo->lastInsertId();

    }

    public function first(string $table, array $conditions = []): ?array
    {
        $where = '';

        if( ! empty($conditions) ) {
            $where = "WHERE " . implode(' AND ',
                    array_map(
                        fn($field) => "$field = :$field", //возвращает каждый ключ массива ($conditions) в формате (к примеру) "name = :name"
                        array_keys($conditions) // получаю массив только ключей из массива переданого в саму функцию first
                        )
                    );
            //получаю (примерно такое) "Where name = :name AND age = :age AND city = :city"
        }

        $sql = "SELECT * FROM $table $where LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($conditions);
        $result = $stmt->fetch(mode: \PDO::FETCH_ASSOC);

        return $result ?: null;

    }

    private function connect() // получаю данные со стороннего файла и настраиваю подключение с бд
    {

        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');
        $dbname = $this->config->get('database.dbname');
        $user_name = $this->config->get('database.user_name');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');


        try {
            $this->pdo = new \PDO("$driver:host=$host;port=$port;dbname=$dbname;charset=$charset", $user_name, $password);
        } catch (\PDOException $exception)
        {
            exit("database error connect $exception");
        }
    }

}