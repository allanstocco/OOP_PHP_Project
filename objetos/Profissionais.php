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

    function cadastroProf() {
        // insere no banco de dados
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, surname=:surname, especialidade=:especialidade";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->especialidade = htmlspecialchars(strip_tags($this->especialidade));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":especialidade", $this->especialidade);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
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
