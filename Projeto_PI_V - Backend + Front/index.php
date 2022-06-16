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


?>
<body>
<body>
    <main>
        <div class="titulo">
            <h1>Painel</h1>
        </div>
        <div class="container-dados-vagas" fixed>
            <div class="dados-vagas">
                <i class="fas fa-map-marker-alt" id="vagas-icon"></i>
                <p>Total de vagas disponíveis:</p>
                <div class="valor-total">
                <strong><?php echo " $total_vagas" ?></strong>
                </div>
            </div>

            <div class="dados-vagas">
                <i class="fas fa-times-circle" id="vagas-icon"></i>
                <p>Total de vagas ocupadas:</p>
                <div class="valor-total">
                    <strong><?php echo " $total_vagas_ocupadas" ?></strong>
                </div>
            </div>
        </div>
        <div class="container-dados-vagas-02">
            <div class="dashboard"></div>
        </div>
    </main>

</body>
</body>