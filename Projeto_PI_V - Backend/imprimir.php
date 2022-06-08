<head>
    <?php include('db/config.php');
    session_start();
    if (@$_SESSION["nivel_usuario"] != "Operador" && @$_SESSION["nivel_usuario"] != "Administrador") {
        echo "<script>alert('Você não tem permissão para acessar esta página!');top.location.href='index.php';</script>";
    }
    ?>
</head>
<?php
//Este valor de placa é passado via GET de uma página para outra
$placa = @$_GET['placa'];
$saida = @$_GET['saida']; // se for ticket com get de saida ele acrescenta o campo de valor
$id_veiculo = @$_GET['veiculo'];


if (!empty($placa)) {
    // Mostrar dados para fazer impressão de entrada
    $result_vagas = "SELECT * FROM veiculos WHERE placa='$placa'";
    $result_verifica_vagas = mysqli_query($con, $result_vagas);
    while ($result_vagas = mysqli_fetch_assoc($result_verifica_vagas)) {
        echo "Ticket: " . fzerosnafrente($result_vagas['id_veiculo'], 7) . "<br>";
        echo "Veículo: " . $result_vagas['nome_veiculo'] . "<br>";
        echo "Placa: " . $result_vagas['placa'] . "<br>";
        $tamanho = $result_vagas['tamanho'];
        echo "Categoria: " . $result_vagas['nome_categoria'] . "<br>";
        $data_entrada = new DateTime($result_vagas['data_entrada']);
        echo "Entrada: " . $data_entrada->format('d-m-Y H:i:s') . "<br>";
    }

    $query = "SELECT * FROM configuracoes WHERE id='1'";
    $execute = mysqli_query($con, $query);
    while ($query = mysqli_fetch_assoc($execute)) {
        echo $query['nome_estacionamento'] . " -- Fone: " . $query['telefone'] . "<br>";
        echo "Endereço: " . $query['endereco'] . "<br>";
        $valor_pequeno = $query['valor_pequeno'] . "<br>";
        $valor_medio = $query['valor_medio'] . "<br>";
        $valor_grande = $query['valor_grande'] . "<br>";
    }
    echo "Tamanho do veículo: " . $tamanho . "<br>";
    if ($tamanho == "pequeno") echo "Valor da hora: R$ " . str_replace(".", ",", $valor_pequeno);
    if ($tamanho == "medio") echo "Valor da hora: R$ " . str_replace(".", ",", $valor_medio);
    if ($tamanho == "grande") echo "Valor da hora: R$ " . str_replace(".", ",", $valor_grande);
    echo "/h <br>";
}

if ($saida == "sim") {
    $query = "SELECT * FROM configuracoes WHERE id='1'";
    $execute = mysqli_query($con, $query);
    while ($query = mysqli_fetch_assoc($execute)) {
        echo $query['nome_estacionamento'] . " -- Fone: " . $query['telefone'] . "<br>";
        echo "Endereço: " . $query['endereco'] . "<br>";
        $valor_pequeno = $query['valor_pequeno'];
        $valor_medio = $query['valor_medio'];
        $valor_grande = $query['valor_grande'];
    }

    $result_vagas = "SELECT * FROM veiculos WHERE id_veiculo='$id_veiculo'";
    $result_verifica_vagas = mysqli_query($con, $result_vagas);
    while ($result_vagas = mysqli_fetch_assoc($result_verifica_vagas)) {
        echo "Ticket: " . fzerosnafrente($result_vagas['id_veiculo'], 7) . "<br>";
        echo "Veículo: " . $result_vagas['nome_veiculo'] . "<br>";
        echo "Placa: " . $result_vagas['placa'] . "<br>";
        $tamanho = $result_vagas['tamanho'];
        echo "Categoria: " . $result_vagas['nome_categoria'] . "<br>";
        $data_entrada = new DateTime($result_vagas['data_entrada']);
        echo "Entrada: " . $data_entrada->format('d-m-Y H:i:s') . " ~~ ";
        $data_saida = new DateTime($result_vagas['data_saida']);
        echo "Saída: " . $data_saida->format('d-m-Y H:i:s') . "<br>";
    }
    echo "Tamanho do veículo: " . $tamanho . "<br>";
    if ($tamanho == "pequeno") echo "Valor da hora: R$ " . str_replace(".", ",", $valor_pequeno);
    if ($tamanho == "medio") echo "Valor da hora: R$ " . str_replace(".", ",", $valor_medio);
    if ($tamanho == "grande") echo "Valor da hora: R$ " . str_replace(".", ",", $valor_grande);
    echo "<br>";

    //retorna o último ID caso o mesmo veículo possua outros registros
    $query = "SELECT MAX(id_pagamento) as id_pagamento FROM pagamentos WHERE id_veiculo='$id_veiculo'";
    $execute = mysqli_query($con, $query);
    while ($query = mysqli_fetch_assoc($execute)) {
        $id_pagamento = $query['id_pagamento'];
    }

    $query = "SELECT valor FROM pagamentos WHERE id_pagamento='$id_pagamento'";
    $execute = mysqli_query($con, $query);
    while ($query = mysqli_fetch_assoc($execute)) {
        echo "Total a pagar: R$" . str_replace(".", ",", $query['valor']);
    }
}

// Completa o numero informado com zeros até chegar ao tamanho escolhido
function fzerosnafrente($numero, $tamanho)
{
    $TamanhoNumero = strlen($numero);

    if ($TamanhoNumero < $tamanho) {
        while ($TamanhoNumero < $tamanho) {
            $numero = "0" . $numero;
            $TamanhoNumero = strlen($numero);
        }
    }

    return $numero;
}
?>

<script>
    window.print();
</script>