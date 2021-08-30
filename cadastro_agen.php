<?php
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include_once 'config/database.php';
include_once 'objetos/Agendamento.php';
include_once 'objetos/Pacientes.php';
include_once 'objetos/Profissionais.php';

$database = new Database();
$db = $database->getConnection();

$agendamentos = new Agendamento($db);
$pacientes = new Pacientes($db);
$profissionais = new Profissionais($db);

$pacientes->id = $id;

$pacientes->readOne();

$page_title = "Agendar Paciente";
include_once 'layout_header.php';

echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Inicio</a>
    </div>";

if ($_POST) {

    $agendamentos->nome = $_POST['nome'];
    $agendamentos->sobrenome = $_POST['sobrenome'];
    $agendamentos->profissional = $_POST['profissinal'];
    $agendamentos->cpf = $_POST['cpf'];
    $agendamentos->data = $_POST['data'];

    if ($agendamentos->agendar()) {
        echo "<div class='alert alert-success'>Paciente Registrado!.</div>";
    } else {
        echo "<div class='alert alert-danger'>Não foi possível cadastrar paciente.</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">

    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Nome:</td>
            <td><input type='text' name='nome' value='<?php echo $pacientes->name; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Sobrenome:</td>
            <td><input type='text' name='sobrenome' value='<?php echo $pacientes->surname; ?>' class='form-control' /></td>
        </tr>
        <tr>
            <td>CPF:</td>
            <td><input type='text' name='cpf' value='<?php echo $pacientes->cpf; ?>' onkeypress="$(this).mask('000.000.000-00')" class='form-control' /></td>
        </tr>
        <tr>
            <td>Profissional:</td>
            <td> 
                <?php
                $stmt = $profissionais->read();

                echo "<select class='form-control' name='profissinal'>";
                echo "<option>Selecionar...</option>";

                while ($row_profissionais = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_profissionais);
                    echo "<option value='{$id}'>{$name} {$surname} - {$especialidade}</option>";
                }

                echo "</select>";
                ?>
            </td>
        </tr>
        <tr>
            <td>Data do Agendamento:</td>
            <td><input type='date' class="form-control" name='data'></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Feito</button>
            </td>
        </tr>
    </table>
</form>

<?php
include_once 'layout_footer.php';
?>

