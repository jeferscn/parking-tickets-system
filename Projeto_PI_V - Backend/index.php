<head>

    <?php include('db/config.php'); ?>
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
    $total_vagas = "Total de vagas: " . $result_vagas['total_vagas'];
    $total_vagas_ocupadas = "<br>Vagas ocupadas: " . $result_vagas['total_vagas_ocupadas'];
}
echo $total_vagas;
echo $total_vagas_ocupadas;


?>