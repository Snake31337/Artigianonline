<?php

class Artigiano {

    private $conn;
    private $table_name = "artigiani";

    public $id;
    public $nome;
    public $cognome;
    public $codice_fiscale;
    public $data_di_nascita;
    public $username;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}






?>