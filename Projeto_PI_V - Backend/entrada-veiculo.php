<head>
    <?php include('db/config.php');
    session_start();
    if (@$_SESSION["nivel_usuario"] != "Operador" && @$_SESSION["nivel_usuario"] != "Administrador") {
        echo "<script>alert('Você não tem permissão para acessar esta página!');top.location.href='index.php';</script>";
    }
    ?>
</head>
<?php
$placa = strtoupper(@$_REQUEST['placa']);
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
<form class="form" action="entrada-veiculo.php" method="post" name="veiculo">
    <table width="20%" align="center">
        <tr>
            <td class="title" colspan="3">Entrada de veículo</td>
        </tr>
        <tr>
            <td>Nome:</td>
            <td colspan="2"><input type="text" name="nome_veiculo" maxlength="30" required placeholder="Nome" value="<?php echo @$_POST['nome_veiculo']; ?>"></td>
        </tr>
        <td>Placa:</td>
        <td colspan="2"><input type="text" id="InputUpper" name="placa" maxlength="10" minlength="3" required placeholder="Placa" value="<?php echo @$_POST['placa']; ?>"></td>
        </tr>
        <tr>
            <td>Tamanho:</td>
            <td colspan="2">
                <table width="100%">
                    <td class="radio-button">
                        Pequeno<input type="radio" name="tamanho_veiculo" required value="pequeno" <?php echo (@$_POST['tamanho_pequeno'] == "tamanho_pequeno" ? " checked" : ""); ?>>
                    </td>
                    <td class="radio-button">
                        Médio<input type="radio" name="tamanho_veiculo" required value="medio" <?php echo (@$_POST['tamanho_medio'] == "tamanho_medio" ? " checked" : ""); ?>>
                    </td>
                    <td class="radio-button">
                        Grande<input type="radio" name="tamanho_veiculo" required value="grande" <?php echo (@$_POST['tamanho_grande'] == "tamanho_grande" ? " checked" : ""); ?>>
                    </td>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <select name="selected_categoria">
                    <option value="">Selecionar categoria</option>
                    <?php
                    $query = "SELECT * FROM categorias ORDER BY nome_categoria ASC";
                    $result_query = mysqli_query($con, $query);
                    while ($result = mysqli_fetch_assoc($result_query)) { ?>
                        <option value="<?php echo $result['nome_categoria']; ?>">
                            <?php echo $result['nome_categoria']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p align="center">
                    <script>
                        document.write("<?php echo "$veiculo_existente" ?>")
                    </script>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="right">
                <input class="submit-button" type="submit" value="Gravar" name="botao">
            </td>
        </tr>
</form>
</table>

<!-- formulário excluir registro de veiculos que não estão mais estacionados -->
<table width="20%" align="center">
    <form class="form" action="entrada-veiculo.php" method="post" name="usuario">
        <tr>
            <td colspan="3">
                <p align="center">Excluir registro</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <select name="selected_registro">
                    <option value="">Selecionar registro</option>
                    <?php
                    $result_usuarios = "SELECT * FROM veiculos WHERE estacionado='nao' ORDER BY placa";
                    $result_verifica_usuarios = mysqli_query($con, $result_usuarios);
                    while ($result_usuarios = mysqli_fetch_assoc($result_verifica_usuarios)) { ?>
                        <option value="<?php echo $result_usuarios['placa']; ?>">
                            <?php echo $result_usuarios['placa']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <input class="botao-excluir" type="submit" value="Excluir" name="botao">
                <input type="hidden" name="id_veiculo" value="<?php echo @$_REQUEST['id_veiculo'] ?>" />
            </td>
        </tr>
</table>
</form>

<style>
    #InputUpper {
        text-transform: uppercase
    }
</style>