<?php

class database
{
    public $connection = DB_CONNECTION;

    public  function connect()
    {

        if (!$this->connection) {
            die('Database Connection Failed Check Settings');
        } else {
            echo 'Database Connection Successful';
            // return ($connection);
        }
    }
}

print_r((new database)->connect());