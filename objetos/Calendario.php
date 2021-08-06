<?php

class Calendario {

    private $conn;
    private $table_name = "agenda";
    public $id;
    public $nome;
    public $sobrenome;
    public $cpf;
    public $dias;
    public $semanas;
    public $mes;

    public function __construct($db) {
        $this->conn = $db;
    }

    function lerDia() {
        
    }

}
