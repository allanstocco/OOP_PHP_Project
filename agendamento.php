<?php
$page_title = "Agendamentos";
include_once 'layout_header.php';
include_once 'cadastro_agen.php';

include_once 'config/database.php';
include_once 'objetos/Pacientes.php';
include_once 'objetos/Profissionais.php';
?>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
<link rel="stylesheet" href="libs/css/calendario.css"/>


<?php
echo "<div class='right-button-margin'>
    <a href='index.php' class='btn btn-default pull-right'>Inicio</a>
    </div>";

echo "<table class='table table-hover table-responsive table-bordered' style='width: 650px;'>";
echo "<tr>";
echo "<th style='text-align: center;'>Nome</th>";
echo "<th style='text-align: center;'>Sobrenome</th>";
echo "<th style='text-align: center;'>CPF</th>";
?>

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





<?php
include_once 'layout_footer.php';
?>


