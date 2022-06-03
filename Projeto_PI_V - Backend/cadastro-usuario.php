<head>
    <?php include('db/config.php');
    session_start();
    if (@$_SESSION["nivel_usuario"] != "Administrador") echo "<script>alert('Você não têm permissão para acessar esta página!');top.location.href='index.php';</script>";
    ?>
</head>
<?php
if (@$_REQUEST['botao'] == "Gravar") {

    $senha = md5(@$_POST['senha']);
    $nivel = "Operador";
    $login_existente;

    $verifica_registro = "SELECT * FROM usuarios WHERE email='{$_REQUEST['email']}'";
    $result_verifica_registro = mysqli_query($con, $verifica_registro);

    if (mysqli_num_rows($result_verifica_registro) > 0) {
        $login_existente = "Este login já existe, tente outra opção!";
        echo mysqli_error($con);
    } else {
        $insere = "INSERT into usuarios (nome_usuario, email, senha, nivel) VALUES ('{$_POST['nome']}', '{$_POST['email']}', '$senha', '$nivel')";
        $result_insere = mysqli_query($con, $insere);
        echo "<script>alert('Cadastro efetuado com sucesso!');top.location.href='cadastro-usuario.php';</script>";
    }
}

if (@$_REQUEST['botao'] == "Excluir") {
    @$selected_usuario = $_POST['selected_usuario'];

    if (!empty($selected_usuario)) {
        $query_excluir = "DELETE FROM usuarios WHERE nome_usuario='$selected_usuario'";
        $result_update = mysqli_query($con, $query_excluir);
        if ($result_update) {
            echo "<script>alert('Usuário excluído com sucesso!');top.location.href='cadastro-usuario.php';</script>";
        } else {
            echo "<script>alert('Não foi possível excluir!');top.location.href='cadastro-usuario.php';</script>";
        }
    } else {
        echo "<script>alert('Você precisa selecionar uma usuário!');</script>";
    }
}
?>

<form class="form" action="cadastro-usuario.php" method="post" name="usuario">
    <table width="20%" align="center">
        <tr>
            <td class="title" colspan="3">Cadastrar usuário</td>
        </tr>
        <tr>
            <td>Nome:</td>
            <td colspan="2"><input type="text" name="nome" required placeholder="Nome" value="<?php echo @$_POST['nome_usuario']; ?>"></td>
        </tr>
        <td>Email:</td>
        <td colspan="2"><input type="email" name="email" maxlength="30" minlength="3" required placeholder="Email" value="<?php echo @$_POST['email']; ?>"></td>
        </tr>
        <tr>
            <td>Senha:</td>
            <td colspan="2"><input type="password" name="senha" maxlength="30" minlength="3" required placeholder="Senha" value="<?php echo @$_POST['senha']; ?>"></td>
        </tr>
        <tr>
            <td colspan="2">
                <p align="center">
                    <script>
                        document.write("<?php echo "$login_existente" ?>")
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

<table width="20%" align="center">
    <form class="form" action="cadastro-usuario.php" method="post" name="usuario">
        <tr>
            <td colspan="3">
                <p align="center">Excluir usuário</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <select name="selected_usuario">
                    <option value="">Selecionar usuário</option>
                    <?php
                    $result_usuarios = "SELECT * FROM usuarios WHERE nivel='Operador' ORDER BY nome_usuario";
                    $result_verifica_usuarios = mysqli_query($con, $result_usuarios);
                    while ($result_usuarios = mysqli_fetch_assoc($result_verifica_usuarios)) { ?>
                        <option value="<?php echo $result_usuarios['nome_usuario']; ?>">
                            <?php echo $result_usuarios['nome_usuario']; ?>
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
                <input type="hidden" name="id_usuario" value="<?php echo @$_REQUEST['id_usuario'] ?>" />
            </td>
        </tr>
</table>
</form>