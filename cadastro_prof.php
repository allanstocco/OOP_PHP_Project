<?php
include_once 'config/database.php';
include_once 'objetos/Pacientes.php';
include_once 'objetos/Profissionais.php';

$database = new Database();
$db = $database->getConnection();

$paciantes = new Pacientes($db);
$profissionais = new Profissionais($db);

$page_title = "Cadastro dos Profissionais";
include_once 'layout_header.php';

echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Inicio</a>
    </div>";

if ($_POST) {

    $profissionais->name = $_POST['name'];
    $profissionais->surname = $_POST['surname'];
    $profissionais->especialidade = $_POST['especialidade'];

    if ($profissionais->cadastroProf()) {
        echo "<div class='alert alert-success'>Profissional Adicionado!</div>";
    } else {
        echo "<div class='alert alert-danger'>Profissional não adicionado.</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Nome:</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
        <tr>
            <td>Sobrenome:</td>
            <td><input type='text' name='surname' class='form-control' /></td>
        </tr>
        <tr>
            <td>Especialidade:</td>
            <td><input type='text' name='especialidade' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </td>
        </tr>
    </table>
</form>














