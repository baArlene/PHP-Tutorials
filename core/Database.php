<?php

namespace core;

use PDO;

//connect to PostgresSQL database / MySQL and execute a query
class Database
{
    public $connection;

    public $statement;

    public function __construct($config, $username = 'postgres.xzmpuksvnznpxnukxuzm', $password = 'i000Cxcijrx72dr3')
    {

        $dsn = 'pgsql:' . http_build_query($config, '', ';');


        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {

        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (!$result) {
            abort();
        }

        return $result;
    }
}