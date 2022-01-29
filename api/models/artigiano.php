<?php

class Artigiano {

    private $conn;
    private $table_name = "artigiano";

    public $CodiceArtigiano;
    public $Nome;
    public $Cognome;
    public $CodiceFiscale;
    public $DataDiNascita;
    public $Username;
    public $Password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT a.CodiceArtigiano, a.Nome, a.Cognome, a.CodiceFiscale, a.DataDiNascita, a.Username, a.Password
                FROM " . $this->table_name . " a"; 
        
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function create() {
        $query = "INSERT INTO 
                    " . $this->table_name . "
                SET Nome=:Nome, Cognome=:Cognome, CodiceFiscale=:CodiceFiscale, DataDiNascita=:DataDiNascita, Username=:Username, Password=:Password";
    
        $stmt = $this->conn->prepare($query);

        $this->Nome=htmlspecialchars(strip_tags($this->Nome));
        $this->Cognome=htmlspecialchars(strip_tags($this->Cognome));
        $this->CodiceFiscale=htmlspecialchars(strip_tags($this->CodiceFiscale));
        $this->DataDiNascita=htmlspecialchars(strip_tags($this->DataDiNascita));
        $this->Username=htmlspecialchars(strip_tags($this->Username));
        $this->Password=htmlspecialchars(strip_tags($this->Password));

        $stmt->bindParam(":Nome", $this->Nome);
        $stmt->bindParam(":Cognome", $this->Cognome);
        $stmt->bindParam(":CodiceFiscale", $this->CodiceFiscale);
        $stmt->bindParam(":DataDiNascita", $this->DataDiNascita);
        $stmt->bindParam(":Username", $this->Username);
        $stmt->bindParam(":Password", $this->Password);

        if($stmt->execute()) {
            return true;
        }

        return false;

        /* JSON Create request
        {
            "Nome" : "Leonardo",
            "Cognome" : "Grimaldi",
            "CodiceFiscale" : "GRMLRD",
            "DataDiNascita" : "2003-02-22",
            "Username" : "snake",
            "Password" : "xdd"
        }
        */
    }
}






?>