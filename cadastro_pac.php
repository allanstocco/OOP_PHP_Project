<?php
include_once 'config/database.php';
include_once 'objetos/Pacientes.php';
include_once 'objetos/Profissionais.php';

// Faz a conexão com o BancoDados ----------------------------------------------

$database = new Database();
$db = $database->getConnection();

// Instancia os objetos já com a conexão ao BancoDados -------------------------

$pacientes = new Pacientes($db);    
$profissionais = new Profissionais($db);

// Inclue Layout_header --------------------------------------------------------

$page_title = "Cadastrar Paciente:";
include_once "layout_header.php";

echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Inicio</a>
    </div>";

// Cadastro --------------------------------------------------------------------
if ($_POST) {

    // Determina o cadastro dos valores dos atributos

    $pacientes->name = $_POST['name'];
    $pacientes->surname = $_POST['surname'];
    //$pacientes->ts1 = $_POST['ts1']; 
    //$pacientes->ts2 = $_POST['ts2'];
    $pacientes->cpf = $_POST['cpf'];
    $pacientes->telefone = $_POST['telefone'];
    $pacientes->email = $_POST['email'];
    $pacientes->description = $_POST['description'];
    $pacientes->profissionais_id = $_POST['profissionais_id'];

    // Cadastra o Paciente.
    if ($pacientes->create()) {
        echo "<div class='alert alert-success'>Paciente Registrado!.</div>";
    }

    // Caso inválido, executa uma mensagem de erro.
    else {
        echo "<div class='alert alert-danger'>Não foi possível cadastrar paciente.</div>";
    }
}
?>

<!----------------- HTML renderiza Paciente ------------------------------->

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

        <!-- comment <tr>
            <td>Sexo:</td>
            <td><fieldset>
                    <input class='' type="radio" name="ts1" id="cMasc"/><label for="cMasc">  Masculino</label><br>
                    <input class='' type="radio" name="ts2" id="cFem"/><label for="cFem">  Feminino</label>
                </fieldset></td>
        </tr>-->

        <tr>
            <td>CPF:</td>
            <td><input type='text' name='cpf' onkeypress="$(this).mask('000.000.000-00')" class='form-control' /></td>
        </tr>
        <tr>
            <td>Telefone:</td>
            <td><input type='text' name='telefone' onkeypress="$(this).mask('(00) 00000-0009')" class='form-control' /></td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td><input type='text' name='email' class='form-control' /></td>
        </tr>
        <tr>
            <td>Descrição:</td>
            <td><textarea name='description' class='form-control' maxlength="50" ></textarea></td>
        </tr>
        <!------------------------ Desativado Opção Selecionar Prof no Cadastro
            <tr>
            <td>Consulta / Profissional:</td>
            <td>

                Profissionais DropDown

                <?php
                /* LÊ PROFISSIONAIS DO BATABASE:

                $stmt = $profissionais->read();

                // COLOCA PROFISSIONAIS EM DROPDOWN:

                echo "<select class='form-control' name='profissionais_id'>";
                echo "<option>Selecionar...</option>";

                while ($row_profissionais = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_profissionais);
                    echo "<option value='{$id}'>{$name} {$surname} - {$especialidade}</option>";
                }

                echo "</select>";
                 
                 */
                ?>
            </td>
        </tr>
        ----------------------------------------------------------------------->
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Feito</button>
            </td>
        </tr>

    </table>
</form>
<?php
//----------------------------------footer--------------------------------------
include_once 'layout_footer.php';
?>