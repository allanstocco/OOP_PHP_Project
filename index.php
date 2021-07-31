<?php

// Pagina dada no parametro de URL como First Pag:------------------------------

$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Define número de registros por página:---------------------------------------

$records_per_page = 5;

// Calculate for the query LIMIT clause:----------------------------------------

$from_record_num = ($records_per_page * $page) - $records_per_page;

// INCLUE FILES CLASSES E DATABASE:---------------------------------------------

include_once 'config/database.php';
include_once 'objetos/Pacientes.php';
include_once 'objetos/Profissionais.php';

// Faz a conexão com o BancoDados ----------------------------------------------

$database = new Database();
$db = $database->getConnection();

// Instancia os objetos já com a conexão ao BancoDados -------------------------

$pacientes = new Pacientes($db);
$profissionais = new Profissionais($db);

// CONSULTA PACIENTES:
$stmt = $pacientes->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// LAYOUT HEADER 
$page_title = "Inicio";
include_once "layout_header.php";

echo "<div class='right-button-margin'>
    <a href='cadastro_pac.php' class='btn btn-default pull-right'>Novo Paciente</a>
</div>";
echo "<div class='right-button-margin'>
    <a href='cadastro_prof.php' class='btn btn-default pull-right'>Novo Profissional</a>
</div>";

if ($num > 0) {

    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th>Nome</th>";
    echo "<th>Sobrenome</th>";
    //  echo "<th>Sexo</th>";
    echo "<th>CPF</th>";
    echo "<th>Telefone</th>";
    echo "<th>E-mail</th>";
    echo "<th>Descrição</th>";
    echo "<th>Profissional</th>";
    echo "<th>Ações</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$surname}</td>";
        //echo "<td>{$ts1}</td>";
        //echo "<td>{$ts2}</td>";
        echo "<td>{$cpf}</td>";
        echo "<td>{$telefone}</td>";
        echo "<td>{$email}</td>";
        echo "<td>{$description}</td>";
        echo "<td>";
        $profissionais->id = $profissionais_id;
        $profissionais->readName();
        echo $profissionais->name . " ";
        echo $profissionais->surname;
        echo " - " . $profissionais->especialidade;
        echo "</td>";
        echo "<td>";
        echo "<a href='leitura_pac.php?id={$id}' class='btn btn-primary left-margin'>
              <span class='glyphicon glyphicon-list'></span> Ler
              </a>
              <a href='update_paciente.php?id={$id}' class='btn btn-info left-margin'>
              <span class='glyphicon glyphicon-edit'></span> Editar
              </a>
              <a delete-id='{$id}' class='btn btn-danger delete-object'>
              <span class='glyphicon glyphicon-remove'></span> Excluir
              </a>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";

    // paging buttons will be here ---------------------------------------------
    $page_url = "index.php?";

    // Conta todos os pacientes no Database para calcular o número de paginas---
    $total_rows = $pacientes->countAll();

    // Botoes Pag:
    include_once 'paging.php';
} else {
    echo "<div class='alert alert-info'>Não há pacientes!</div>";
}
// Footer
include_once "layout_footer.php";
?>



