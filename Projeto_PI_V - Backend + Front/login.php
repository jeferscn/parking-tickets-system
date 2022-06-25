<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="CSS/login.css">
	<title>Login</title>
    <?php
    include('db/config.php');
    session_start(); // inicia a sessao	
    ?>
</head>

<?php
if (@$_REQUEST['botao'] == "Entrar") {
    $login = @$_POST['login'];
    $senha = md5($_POST['senha']);

    $query = "SELECT * FROM usuarios WHERE nome_usuario = '$login' AND senha = '$senha' ";
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

<body>
<div class="bg-image">
    <div id="login">
        <form class="card" action="" method="post" name="usuario">
            <div class="card-content">
                <div class="card-content-area">
                    <table  align="center">
                        <tr>
                            <td class="title" colspan="3">Login</td>
                        </tr>
                            <div class="card-content-area">
                                <tr>
                                    <td colspan="2">
                                        Usuário:
                                        <br>
                                        <input type="text" name="login" required placeholder="Login" value="<?php echo @$_POST['login']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        Senha:
                                        <br>
                                        <input type="password" name="senha" required placeholder="Senha" value="<?php echo @$_POST['idade']; ?>">
                                    </td>
                                </tr>
                            </div>
                        <tr>
                            <td colspan="3" align="right">
                                <div class="card-footer">
                                    <input class="submit" type="submit" value="Entrar" name="botao">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>     
        </form>
    </div>
</div>
</body>
