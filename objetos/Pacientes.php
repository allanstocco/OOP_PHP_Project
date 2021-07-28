<?php

class Pacientes {

    private $conn;
    private $table_name = "pacientes";
    // object properties
    public $id;
    public $name;
    public $surname;
    //public $ts1;
    //public $ts2;
    public $cpf;
    public $telefone;
    public $email;
    public $description;
    public $profissionais_id;
    public $timestamp;

    public function __construct($db) {
        $this->conn = $db;
    }

    // CADASTRA VALORES---------------------------------------------------------

    function create() {

        //ESCREVE A CONSULTA AO DB
        $query = "INSERT INTO
                    " . $this->table_name . " SET name=:name, surname=:surname, cpf=:cpf, telefone=:telefone, email=:email, description=:description, profissionais_id=:profissionais_id, created=:created";

        $stmt = $this->conn->prepare($query);

        // VALORES POSTADOS:

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        //$this->ts1 = htmlspecialchars(strip_tags($this->ts1));
        //$this->ts2 = htmlspecialchars(strip_tags($this->ts2));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->profissionais_id = htmlspecialchars(strip_tags($this->profissionais_id));

        // PEGAR O TIME-STAMP FOR CREATED FIELD:

        $this->timestamp = date('Y-m-d H:i:s');

        // BIND VALORES

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        //$stmt->bindParam(":ts1", $this->ts1);
        //$stmt->bindParam(":ts2", $this->ts2);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":profissionais_id", $this->profissionais_id);
        $stmt->bindParam(":created", $this->timestamp);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readAll($from_record_num, $records_per_page) {

        $query = "SELECT
                id, name, surname, cpf, telefone, email, description, profissionais_id
            FROM
                " . $this->table_name . "
            ORDER BY
                name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function countAll() {

        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

    function readOne() {

        $query = "SELECT
                id, name, surname, cpf, telefone, email, description, profissionais_id
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->surname = $row['surname'];
        $this->cpf = $row['cpf'];
        $this->telefone = $row['telefone'];
        $this->email = $row['email'];
        $this->description = $row['description'];
        $this->profissionais_id = $row['profissionais_id'];
    }

    function update() {

        $query = "UPDATE
                " . $this->table_name . "
            SET
                name=:name, surname=:surname, cpf=:cpf, telefone=:telefone, email=:email, description=:description, profissionais_id=:profissionais_id
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        // VALORES ATUALIZADOS POSTADOS
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->profissionais_id = htmlspecialchars(strip_tags($this->profissionais_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // BIND PARAMETROS:
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        //$stmt->bindParam(":ts1", $this->ts1);
        //$stmt->bindParam(":ts2", $this->ts2);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":profissionais_id", $this->profissionais_id);
        $stmt->bindParam(":id", $this->id);

        // EXECUTA A CONSULTA:
        
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function delete() {

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result === $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}

?>
