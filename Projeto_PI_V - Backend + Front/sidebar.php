<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include('db/config.php');
    session_start();
    $id_usuario = @$_SESSION['id_usuario'];
    include('db/config.php');
    $query = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";
    $result = mysqli_query($con, $query);
    while ($usuario = mysqli_fetch_assoc($result)) {
        $login = $usuario['nome_usuario'];
        $nivel = $usuario['nivel'];
    }

    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sidebar.css">

    <title>Entrada</title>
</head>
<div class="topbar">
    <img src="img/corp.jpg" alt="logo marca">
    <i class="fas fa-light fa-user" id="user-icon"><?php echo "[" . @$nivel . "] " . @$login;  ?></i>
</div>

<div class="sidebar">
    <header> Menu </header>
    <hr>
    <a class="a-efeito" href="index.php">
        <i class="fas fa-qrcode"></i>
        <span>Painel</span>
    </a>
    <a class="a-efeito" href="entrada-veiculo.php">
        <i class="fas fa-car"> </i>
        <span>Entrada veículo</span>

    </a>
    <a class="a-efeito" href="saida-veiculo.php">
        <i class="fas fa-car-side"></i>
        <span>Saída veículo</span>
    </a>
    <?php if (@$_SESSION["nivel_usuario"] == "Administrador") { ?>
        <!-- 
    Jogar aqui o que for apenas pro ADM acessar 
-->
        <!-- 
    COLOCAR UM DROPDOWN PARA CADASTROS
-->

        <a class="a-efeito" href="configuracoes.php">
            <i class="fas fa-ticket-alt"></i>
            <span>configurações</span>
        </a>
        <a class="a-efeito" href="cadastro-categoria.php">
            <i class="fas fa-ticket-alt"></i>
            <span>cadastrar categoria</span>
        </a>
        <a class="a-efeito" href="cadastro-forma-pagamento.php">
            <i class="fas fa-ticket-alt"></i>
            <span>cad. pagamento</span>
        </a>
        <a class="a-efeito" href="cadastro-usuario.php">
            <i class="fas fa-ticket-alt"></i>
            <span>cadastrar usuario</span>
        </a>
    <?php } ?>

    <?php if (@$_SESSION["nivel_usuario"] == "Administrador" || @$_SESSION["nivel_usuario"] == "Operador") { ?>
        <a class="a-efeito" href="logout.php">
            <i class="fas fa-ticket-alt"></i>
            <span>logout</span>
        </a>
    <?php } ?>
</div>

<body>
</body>

</html>