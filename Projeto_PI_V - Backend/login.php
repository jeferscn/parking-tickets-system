<head>
    <?php
    include('db/config.php');
    session_start(); // inicia a sessao	
    ?>
</head>

<?php
if (@$_REQUEST['botao'] == "Entrar") {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $query = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha' ";
    $result = mysqli_query($con, $query);
    while ($coluna = mysqli_fetch_array($result)) {
        $_SESSION["id_usuario"] = $coluna["id_usuario"];
        $_SESSION["email_usuario"] = $coluna["email"];
        $_SESSION["nome_usuario"] = $coluna["nome_usuario"];
        $_SESSION["nivel_usuario"] = $coluna["nivel"];

        // caso queira direcionar para páginas diferentes

        $niv = $coluna['nivel'];
        if ($niv == "Operador") {
            echo "<script>top.location.href='index.php';</script>";
            exit;
        } elseif ($niv == "Administrador") {
            echo "<script>top.location.href='index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Login ou senha incorretos, tente novamente!');top.location.href='login.php';</script>";
        }
    }
}
?>

<form class="form" action="#" method="post" name="usuario">
    <table width="20%" align="center">
        <tr>
            <td class="title" colspan="3">Login de usuário</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td colspan="2"><input type="text" name="email" required placeholder="Email" value="<?php echo @$_POST['email']; ?>"></td>
        </tr>
        <tr>
            <td>Senha:</td>
            <td colspan="2"><input type="password" name="senha" required placeholder="Senha" value="<?php echo @$_POST['idade']; ?>"></td>
        </tr>
        <tr>
            <td colspan="3" align="right">
                <input class="submit-button" type="submit" value="Entrar" name="botao">
            </td>
        </tr>
    </table>
</form>