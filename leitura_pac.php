<?php

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// INCLUE OBJETOS E DATABASE  

include_once 'config/database.php';
include_once 'objetos/Pacientes.php';
include_once 'objetos/Profissionais.php';

// Faz a conexão com o BancoDados ----------------------------------------------
$database = new Database();
$db = $database->getConnection();

// Instancia os objetos, já com a conexão ao BancoDados ------------------------

$pacientes = new Pacientes($db);
$profissionais = new Profissionais($db);

// Define ID propriedade do paciente a ser lido---------------------------------

$pacientes->id = $id;

// Lê os detalhes do Paciente a ser lido:---------------------------------------

$pacientes->readOne();
// Layout header do Painel do Paciente
$page_title = "Painel do Paciente";
include_once "layout_header.php";

// Botões Ler Pacientes:
echo "<div class='right-button-margin'>";
echo "<a href='index.php' class='btn btn-default pull-right'>Pacientes</a>";
echo "</div>";

echo "<table class='table table-hover table-responsive table-bordered'>";

echo "<tr>";
echo "<td>Nome:</td>";
echo "<td>{$pacientes->name}</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Sobrenome:</td>";
echo "<td>{$pacientes->surname}</td>";
echo "</tr>";

echo "<tr>";
echo "<td>CPF:</td>";
echo "<td>{$pacientes->cpf}</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Telefone:</td>";
echo "<td>{$pacientes->telefone}</td>";
echo "</tr>";

echo "<tr>";
echo "<td>E-mail:</td>";
echo "<td>{$pacientes->email}</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Descrição:</td>";
echo "<td>{$pacientes->description}</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Profissional:</td>";
echo "<td>";
// Mostra o nome do Profissional
$profissionais->id = $pacientes->profissionais_id;
if ($profissionais->id == false) {
    echo "Nenhum profissional registrado.";
} else {
    $profissionais->readName();
    echo $profissionais->name . " ";
    echo $profissionais->surname;
    echo " - " . $profissionais->especialidade;
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

// footer
include_once "layout_footer.php";
?>
