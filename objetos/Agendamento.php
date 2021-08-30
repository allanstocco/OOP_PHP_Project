<?php

class Agendamento {

    private $conn;
    private $table_name = "agenda";
    public $id;
    public $nome;
    public $sobrenome;
    public $profissional;
    public $cpf;
    public $data;

    public function __construct($db) {
        $this->conn = $db;
    }

    function agendar() {

        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, sobrenome=:sobrenome, profissional=:profissional, cpf=:cpf, data=:data";

        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->sobrenome = htmlspecialchars(strip_tags($this->sobrenome));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->profissional = htmlspecialchars(strip_tags($this->profissional));
        $this->data = htmlspecialchars(strip_tags($this->data));
      

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":sobrenome", $this->sobrenome);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":profissional", $this->profissional);
        $stmt->bindParam(":data", $this->data);


        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    function mostrarAgendamentos($dados) {
        
        $query = "SELECT id, nome, sobrenome, cpf, profissional FROM " . $this->table_name . " WHERE data like '$dados%' ORDER BY nome";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    

}
