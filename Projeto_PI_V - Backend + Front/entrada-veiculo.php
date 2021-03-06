<head>
    <?php include('sidebar.php'); ?>
    <?php include('db/config.php');
    session_start();
    if (@$_SESSION["nivel_usuario"] != "Operador" && @$_SESSION["nivel_usuario"] != "Administrador") {
        echo "<script>alert('Você não tem permissão para acessar esta página!');top.location.href='index.php';</script>";
    }
    ?>
    <link rel="stylesheet" href="CSS/entrada.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/entrada.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Entrada</title>
</head>
<?php
$placa = @$_REQUEST['placa'];
if (@$_REQUEST['botao'] == "Gravar") {

    $senha = md5(@$_POST['senha']);
    $estacionado = "sim";
    $veiculo_existente;


    //Verifica se já existe o registro no banco
    $verifica_registro = "SELECT * FROM veiculos WHERE placa='{$_REQUEST['placa']}' AND estacionado='sim'";
    $result_verifica_registro = mysqli_query($con, $verifica_registro);

    if (mysqli_num_rows($result_verifica_registro) > 0) {
        $veiculo_existente = "Erro: Este veículo está estacionado!";
        echo mysqli_error($con);
    } else {
        // insere no sistema se não existir registro igual
        $insere = "INSERT into veiculos (placa, nome_veiculo, tamanho, nome_categoria, estacionado) VALUES ('{$_POST['placa']}', '{$_POST['nome_veiculo']}', '{$_POST['tamanho_veiculo']}', '{$_POST['selected_categoria']}', '$estacionado')";
        $result_insere = mysqli_query($con, $insere);
        $insere = "UPDATE configuracoes SET total_vagas_ocupadas = total_vagas_ocupadas + 1";
        $result_insere = mysqli_query($con, $insere);
        echo "<script>window.open('imprimir.php?placa=$placa', '_blank');</script>";
        echo "<script>alert('Entrada efetuado com sucesso!');top.location.href='entrada-veiculo.php';</script>";
    }
}

// faz exclusão do registro
if (@$_REQUEST['botao'] == "Excluir") {
    @$selected_registro = $_POST['selected_registro'];

    if (!empty($selected_registro)) {
        $query_excluir = "DELETE FROM veiculos WHERE placa='$selected_registro'";
        $result_update = mysqli_query($con, $query_excluir);
        if ($result_update) {
            echo "<script>alert('Registro excluído com sucesso!');top.location.href='entrada-veiculo.php';</script>";
        } else {
            echo "<script>alert('Não foi possível excluir!');top.location.href='entrada-veiculo.php';</script>";
        }
    } else {
        echo "<script>alert('Você precisa selecionar um registro!');</script>";
    }
}
?>
<!-- formulário entrada de veiculo -->

</table>


<main>
    <form class="form" action="entrada-veiculo.php" method="post" name="veiculo">

        <div class="titulo">
            <h1>Entrada Veículo</h1>
        </div>
        <div class="container-dados-vagas">
            <div class="dados-vagas">
                <label for="">Placa:</label>
                <br>
                <input type="text" name="placa" oninput="handleInput(event)" maxlength="10" minlength="3" required placeholder="Placa" value="<?php echo @$_POST['placa']; ?>">
                <label for="">Nome:</label>
                <br>
                <input type="text" name="nome_veiculo" oninput="handleInput(event)" maxlength="30" required placeholder="Nome" value="<?php echo @$_POST['nome_veiculo']; ?>">

                <!--             <div class="dropdown">
  <button class="dropbtn">Categoria:</button>
  <div class="dropdown-content">
    <a >Marca 1</a>
    <a >Marca 2</a>
    <a >Marca 3</a>
  </div>
</div>-->
            </div>
            <div class="container-select-tamanho">
                <div class="select-categoria">
            <label for="">Categoria:</label>
                    <div class="div-select">
                        <select name="selected_categoria">
                            <option value="">Selecionar categoria</option>
                            <?php
                            $result = "SELECT * FROM categorias ORDER BY nome_categoria ASC";
                            $result_verifica = mysqli_query($con, $result);
                            while ($result_cores = mysqli_fetch_assoc($result_verifica)) { ?>
                                <option value="<?php echo $result_cores['nome_categoria']; ?>">
                                    <?php echo $result_cores['nome_categoria']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <tr>
                    <div class="container-tamanho">
                        <td>Tamanho:</td>
                        <td colspan="2">
                            <table width="100%">
                                <td class="radio-button">
                                    <label for="">Pequeno:</label>
                                    <input type="radio" name="tamanho_veiculo" required value="pequeno" <?php echo (@$_POST['tamanho_pequeno'] == "tamanho_pequeno" ? " checked" : ""); ?>>
                                </td>
                                <td class="radio-button">
                                    <label for="">Médio:</label>
                                    <input type="radio" name="tamanho_veiculo" required value="medio" <?php echo (@$_POST['tamanho_medio'] == "tamanho_medio" ? " checked" : ""); ?>>
                                </td>
                                <td class="radio-button">
                                    <label for="">Grande:</label>
                                    <input type="radio" name="tamanho_veiculo" required value="grande" <?php echo (@$_POST['tamanho_grande'] == "tamanho_grande" ? " checked" : ""); ?>>
                                </td>
                            </table>
                        </td>
                    </div>
                </tr>
            </div>
            <tr>
                <td colspan="2">
                    <p align="center">
                        <script>
                            document.write("<?php echo "$veiculo_existente" ?>")
                        </script>
                    </p>
                </td>
                <div class="container-botoes">
                    <button class="submit-button" type="submit" value="Gravar" name="botao">Salvar</button>
                </div>
        </div>
    </form>
</main>

<script>
    function handleInput(e) {
        var ss = e.target.selectionStart;
        var se = e.target.selectionEnd;
        e.target.value = e.target.value.toUpperCase();
        e.target.selectionStart = ss;
        e.target.selectionEnd = se;
    }
</script>