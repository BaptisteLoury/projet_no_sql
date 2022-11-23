<?php

class Cache
{
    private $conn;

    function __construct()
    {
        $this->conn = new Redis() or die("Cannot load Redis module in PHP.");
        $this->conn->connect('container_redis', 6379);
        $this->conn->auth('mdp');
    }

    /**
     * Renvoi la connexion à la db
     */
    public function getConn()
    {
        return $this->conn;
    }
}