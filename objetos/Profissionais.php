<?php

class Profissionais {

    private $conn;
    private $table_name = "profissionais";
    // object properties
    public $id;
    public $name;
    public $surname;
    public $especialidade;
    public $telefone;
    public $email;
    public $valor;

    public function __construct($db) {
        $this->conn = $db;
    }

    // USADO PARA SELECIONAR EM DROPDOWN LIST:
    function read() {
        
        //SELECIONA TODO O DATA
        
        $query = "SELECT id, name, surname, especialidade FROM " . $this->table_name . " ORDER BY name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function readName() {

        $query = "SELECT name, surname, especialidade FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->surname = $row['surname'];
        $this->especialidade = $row['especialidade'];
        
    }

}

?>
