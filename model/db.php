<?php

class DB
{
    private $dbconn;

    function __construct()
    {
        $this->dbconn = pg_connect("host=localhost dbname=unposteur user=admin password=admin")
        or die('Connexion impossible : ' . pg_last_error());
    }

    /**
     * Renvoi la connexion à la db
     */
    public function getDbconn()
    {
        return $this->dbconn;
    }

    /**
     * Ferme la connexion à la db
     * @return void
     */
    public function close(){
        pg_close($this->dbconn);
    }
}