<?php

// CHECA SE O VALOR FOI POSTADO:

if ($_POST) {

    // INCLUE DATABASE E CLASSE FILE:
    include_once 'config/database.php';
    include_once 'objetos/Pacientes.php';

    // CONEXÃO COM DATABASE
    $database = new Database();
    $db = $database->getConnection();

    // INSTANCIAR OBJETO CONECTADO AO DATABASE
    $pacientes = new Pacientes($db);

    // DEFINE O PACIENTE ID A SER DELETADO:
    $pacientes->id = $_POST['object_id'];

    // DELETA O PACIENTE:
    if ($pacientes->delete()) {
        echo "Paciente excluído com êxito.";
    }

    // CASO CONTRÁRIO, ERRO:
    else {
        echo "Não foi possível a exclusão.";
    }
}
?>

