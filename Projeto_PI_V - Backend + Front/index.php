<head>
    <?php
    include('sidebar.php');
    include('db/config.php');
    if (@$_SESSION["nivel_usuario"] != "Operador" && @$_SESSION["nivel_usuario"] != "Administrador") {
        echo "<script>top.location.href='login.php';</script>";
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Home Page</title>
</head>


<?php
//Total de vagas (Livres e Ocupadas)
//Dashboard (Algumas infos do sistema)

// Mostrar número total de vagas, e vagas ocupadas
$total_vagas; // número total de vagas do estacionamento
$total_vagas_ocupadas; // número total de vagas ocupadas
$result_vagas = "SELECT * FROM configuracoes";
$result_verifica_vagas = mysqli_query($con, $result_vagas);
while ($result_vagas = mysqli_fetch_assoc($result_verifica_vagas)) {
    $total_vagas = $result_vagas['total_vagas'];
    $total_vagas_ocupadas = $result_vagas['total_vagas_ocupadas'];
}

$query = "SELECT COUNT(estacionado) FROM veiculos WHERE estacionado='sim'";
$result = mysqli_query($con, $query);
while ($valor = mysqli_fetch_assoc($result)) {
    $qtd_veiculos_estacionados = $valor['COUNT(estacionado)'];
}


?>
<body>
    <body>
        <main>
            <div class="titulo">
                <h1>Painel</h1>
            </div>
            <div class="container-dados-vagas" fixed>
                <div class="dados-vagas">
                    <p>Total de vagas disponíveis</p>
                    <div class="valor-total">
                        <strong><i class="fas fa-map-marker-alt"></i><?php echo $total_vagas - $qtd_veiculos_estacionados ?></strong>
                    </div>
                </div>

                <div class="dados-vagas">
                    
                    <p>Total de vagas ocupadas</p>
                    <div class="valor-total">
                        <strong><i class="fas fa-times-circle"></i><?php echo $qtd_veiculos_estacionados ?></strong>
                    </div>
                </div>
            </div>
        </main>
    </body>
</body>