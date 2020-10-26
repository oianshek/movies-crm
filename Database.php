<?php


class Database
{
    var $host = ""; //database server
    var $user = ""; //database login name
    var $pass = ""; //database login password
    var $database = ""; //database name

    public $link;

    public function __construct($host, $user, $pass, $database)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;
    }

    public function connect()
    {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->database);
        if (mysqli_connect_error()) return null;
        else return $this->link;

    }

    public function connect1()
    {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->database);
        if (mysqli_connect_error()) {
            echo mysqli_connect_error();
        } else
            echo 'cool';

    }


}



