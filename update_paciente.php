<?php
// Layout header desta página:--------------------------------------------------
$page_title = "Atualizar Cadastro Paciente";
include_once "layout_header.php";

echo "<div class='right-button-margin'>
          <a href='index.php' class='btn btn-default pull-right'>Pacientes</a>
     </div>";

// Captura o ID do Paciente a ser atualizado:-----------------------------------

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// INCLUE FILES CLASSES E DATABASE:---------------------------------------------------

include_once 'config/database.php';
include_once 'objetos/Pacientes.php';
include_once 'objetos/Profissionais.php';

// Faz a conexão com o BancoDados ----------------------------------------------

$database = new Database();
$db = $database->getConnection();

// Instancia os objetos já, com a conexão ao BancoDados ------------------------
$pacientes = new Pacientes($db);
$profissionais = new Profissionais($db);

// Define ID propriedades do paciente a ser editado/updated---------------------

$pacientes->id = $id;

// Lê os detalhes do paciente a ser editado/updated:----------------------------

$pacientes->readOne();

// Quando ou Se o Formulário for submit:----------------------------------------
if ($_POST) {

    // Determina o cadastro dos valores dos atributos

    $pacientes->name = $_POST['name'];
    $pacientes->surname = $_POST['surname'];
    $pacientes->cpf = $_POST['cpf'];
    $pacientes->telefone = $_POST['telefone'];
    $pacientes->email = $_POST['email'];
    $pacientes->description = $_POST['description'];
    $pacientes->profissionais_id = $_POST['profissionais_id'];

    // ATUALIZA O PACIENTE:
    if ($pacientes->update()) {
        echo "<div class='alert alert-success alert-dismissable'>";
        echo "Paciente Atualizado.";
        echo "</div>";
    }

    // CASO NÃO POSSÍVEL, MENSAGEM ERRO:
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
        echo "Não foi possível atualizar paciente.";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Nome:</td>
            <td><input type='text' name='name' value='<?php echo $pacientes->name; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Sobrenome:</td>
            <td><input type='text' name='surname' value='<?php echo $pacientes->surname; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>CPF:</td>
            <td><input type='text' name='cpf' onkeypress="$(this).mask('000.000.000-00')" class='form-control' value='<?php echo $pacientes->cpf; ?>'/></td>
        </tr>
        <tr>
            <td>Telefone:</td>
            <td><input type='text' name='telefone' onkeypress="$(this).mask('(00) 00000-00000')" value='<?php echo $pacientes->telefone; ?>' class='form-control' /></td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td><input type='text' name='email' value='<?php echo $pacientes->email; ?>' class='form-control' /></td>
        </tr>
        <tr>
            <td>Descrição</td>
            <td><textarea name='description' class='form-control'><?php echo $pacientes->description; ?></textarea></td>
        </tr>
        <tr>
            <td>Profissionais</td>
            <td>
                <?php
                $stmt = $profissionais->read();

                // PROFISSIONAIS DROPDOWN LIST:

                echo "<select class='form-control' name='profissionais_id'>";

                echo "<option>Selecione...</option>";
                while ($row_profissionais = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $profissionais_id = $row_profissionais['id'];
                    $profissionais_name = $row_profissionais['name'];
                    $profissionais_surname = $row_profissionais['surname'];
                    $profissionais_especialidade = $row_profissionais['especialidade'];

                    // PROFISSIONAIS DEVEM SER SELECIONADOS

                    if ($paciantes->profissionais_id == $profissionais_id) {
                        echo "<option value='$profissionais_id' selected>";
                    } else {
                        echo "<option value='$profissionais_id'>";
                    }

                    echo "$profissionais_name $profissionais_surname - $profissionais_especialidade</option>";
                }
                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </td>
        </tr>

    </table>
</form>


<?php
// Footer
include_once "layout_footer.php";
?>
