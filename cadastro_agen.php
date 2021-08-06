<?php


$page_title = "Cadastrar Agendamento";
include_once "layout_header.php";

include_once 'config/database.php';
include_once 'objetos/Pacientes.php';
include_once 'objetos/Profissionais.php';

// Faz a conexão com o BancoDados ----------------------------------------------

$database = new Database();
$db = $database->getConnection();

// Instancia os objetos já com a conexão ao BancoDados -------------------------

$pacientes = new Pacientes($db);
$profissionais = new Profissionais($db);

