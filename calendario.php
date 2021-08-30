<?php
$page_title = "Agendamentos";
include_once 'layout_header.php';

include_once 'config/database.php';
include_once 'objetos/Agendamento.php';
include_once 'objetos/Calendar.php';
include_once 'objetos/Profissionais.php';
include_once 'objetos/Pacientes.php';

$database = new Database();
$db = $database->getConnection();

$agendamentos = new Agendamento($db);
$profissionais = new Profissionais($db);
$pacientes = new Pacientes($db);

$parametro = filter_input(INPUT_GET, "data");
?>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
<link rel="stylesheet" href="libs/css/Calendarion.css"/>


<?php
echo "<div class='right-button-margin'>
    <a href='index.php' class='btn btn-default pull-right'>Inicio</a>
    </div>";
?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <div class="right-button-margin">
        <input class='btn btn-default pull-left' type='date' name='data'>
        <input class='btn btn-default pull-left' style='background-color: #222227; color: beige;' type='submit' value='Buscar'>
    </div>
</form>

<?php
echo "<table class='table table-hover table-responsive table-bordered'>";
echo "<tr>";
echo "<th style='text-align: center;'>Nome</th>";
echo "<th style='text-align: center;'>Sobrenome</th>";
echo "<th style='text-align: center;'>CPF</th>";
echo "<th style='text-align: center;'>Consulta</th>";
echo "</tr>";

if ($parametro == NULL) {
    False;
} else {
    $dados = $agendamentos->mostrarAgendamentos($parametro);

    while ($row = $dados->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        echo "<tr>";
        echo "<td>{$nome}</td>";
        echo "<td>{$sobrenome}</td>";
        echo "<td>{$cpf}</td>";
        echo "<td>";
        $profissionais->id = $profissional;
        if ($profissionais->id == false) {
            echo "Nenhum profissional registrado.";
        } else {
            $profissionais->readName();
            echo $profissionais->name . " ";
            echo $profissionais->surname;
            echo " - " . $profissionais->especialidade;
            echo "</td>";
        }          
        echo "</tr>";
    }
}
echo "</table>";
?>
<!--
<aside>
    <div class="BoxCal">
        <div class="calendar">
            <div class="month">
                <i class="fas fa-angle-left prev"></i>
                <div class="date">
                    <h1></h1>
                    <p></p>

                </div>
                <i class="fas fa-angle-right next"></i>
            </div>
            <div class="weekdays">
                <div>Dom</div>
                <div>Seg</div>
                <div>Ter</div>
                <div>Qua</div>
                <div>Qui</div>
                <div>Sex</div>
                <div>Sat</div>
            </div>
            <div class="days"></div>
        </div>

    </div>
</aside>
--->






<?php
include_once 'layout_footer.php';
?>


