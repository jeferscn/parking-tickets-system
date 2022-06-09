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

// Variaveis para utilizar em ambas as telas: Impressao de entrada ou saída
if (!empty($placa)) $result_vagas = "SELECT * FROM veiculos WHERE placa='$placa'";
else if (!empty($id_veiculo)) $result_vagas = "SELECT * FROM veiculos WHERE id_veiculo='$id_veiculo'";
$result_verifica_vagas = mysqli_query($con, $result_vagas);
while ($result_vagas = mysqli_fetch_assoc($result_verifica_vagas)) {
    $ticket = "Ticket: #" . fzerosnafrente($result_vagas['id_veiculo'], 7) . "<br>";
    $veiculo = "Veículo:<br>" . $result_vagas['nome_veiculo'] . "<br>";
    $placa = "Placa: " . $result_vagas['placa'] . "<br>";
    $tamanho = $result_vagas['tamanho'];
    $tamanho_formatado = "Tamanho:<br>" . $result_vagas['tamanho'];
    $categoria = "Categoria:<br>" . $result_vagas['nome_categoria'] . "<br>";
    $data_entrada = new DateTime($result_vagas['data_entrada']);
    $data_entrada_formatado = "Entrada:<br>" . $data_entrada->format('d-m-Y H:i:s') . "<br>";
    $data_saida = new DateTime($result_vagas['data_saida']);
    $data_saida_formatado = "Saída:<br>" . $data_saida->format('d-m-Y H:i:s') . "<br>";
}

$query = "SELECT * FROM configuracoes WHERE id='1'";
$execute = mysqli_query($con, $query);
while ($query = mysqli_fetch_assoc($execute)) {
    $nome_estacionamento = $query['nome_estacionamento'];
    $telefone = "Fone: " . $query['telefone'] . "<br>";
    $endereco =  $query['endereco'] . "<br>";
    $valor_pequeno = $query['valor_pequeno'] . "<br>";
    $valor_medio = $query['valor_medio'] . "<br>";
    $valor_grande = $query['valor_grande'] . "<br>";
}

//Checa o tamanho e atribui o valor de cada tamanho.
if ($tamanho == "pequeno") $valor_hora = "Valor da hora:<br>R$ " . str_replace(".", ",", $valor_pequeno);
elseif ($tamanho == "medio") $valor_hora = "Valor da hora:<br>R$ " . str_replace(".", ",", $valor_medio);
elseif ($tamanho == "grande") $valor_hora = "Valor da hora:<br>R$ " . str_replace(".", ",", $valor_grande);

//retorna o último ID caso o mesmo veículo possua outros registros
$query = "SELECT MAX(id_pagamento) as id_pagamento FROM pagamentos WHERE id_veiculo='$id_veiculo'";
$execute = mysqli_query($con, $query);
while ($query = mysqli_fetch_assoc($execute)) {
    $id_pagamento = $query['id_pagamento'];
}

//retorna o valor total a pagar
$query = "SELECT valor FROM pagamentos WHERE id_pagamento='$id_pagamento'";
$execute = mysqli_query($con, $query);
while ($query = mysqli_fetch_assoc($execute)) {
    $total_a_pagar = "Total a pagar: R$" . str_replace(".", ",", $query['valor']);
}

// Mostra os dados que serão impressos no ticket
if (!empty($id_veiculo) && $saida == "sim") {
    // Impressão de saída
    echo "
        <table class='impressao' align='left' width='400px'>
            <tr>
                <td colspan='5' align='left'><b</td>
            </tr>
            <tr>
                <td class='borda' colspan='2' align='center'>" . $nome_estacionamento . "</td>
                <td class='borda' colspan='2' align='center'>" . $telefone . "</td>
            </tr>
            <tr>
                <td class='borda' colspan='5' align='center'>" . $endereco . "</td>
            </tr>
                <td colspan='5' align='left'></td>
            <tr>
                <td class='borda' colspan='5' align='center'>" . $ticket . "</td>
            </tr>
            <tr>
                <td class='borda' colspan='2' align='center'>" . $veiculo . "</td>
                <td class='borda' colspan='3' align='center'>" . $categoria . "</td>
            </tr>
            <tr>
                <td class='borda' colspan='5' align='center'>" . $placa . "</td>
            </tr>
            <tr>
                <td class='borda' colspan='2' align='center'>" . $tamanho_formatado . "</td>
                <td class='borda' colspan='2' align='center'>" . $valor_hora . "</td>
            </tr>
            <tr>
                <td class='borda' colspan='2' align='center'>" . $data_entrada_formatado . "</td>
                <td class='borda' colspan='2' align='center'>" . $data_saida_formatado . "</td>
            </tr>
            <tr>
                <td class='borda' colspan='5' align='center'>" . $total_a_pagar . "</td>
            </tr>
        </table>
        <style>
        .impressao tr td {
            padding: 5px 15px;
        }
        .borda {
            border:1px solid;
        }
        .height{
            50px;
        }
        </style>
    
    ";
} else if (!empty($placa)) {
    // Impressão de entrada
    echo "
    <table class='impressao' align='left' width='400px' border='1'>
        </tr>
            <td colspan='5' align='left'><b</td>
        <tr>
        <tr>
            <td colspan='2' align='center'>" . $nome_estacionamento . "</td>
            <td colspan='2' align='center'>" . $telefone . "</td>
        </tr>
        <tr>
            <td colspan='5' align='center'>" . $endereco . "</td>
        </tr>
            <td colspan='5' align='left'></td>
        <tr>
            <td colspan='5' align='center'>" . $ticket . "</td>
        </tr>
        <tr>
            <td colspan='2' align='center'>" . $veiculo . "</td>
            <td colspan='3' align='center'>" . $categoria . "</td>
        </tr>
        <tr>
            <td colspan='5' align='center'>" . $placa . "</td>
        </tr>
        <tr>
        <td colspan='2' align='center'>" . $tamanho_formatado . "</td>
            <td colspan='2' align='center'>" . $valor_hora . "</td>
        </tr>
        <tr>
            <td colspan='2' align='center'>" . $data_entrada_formatado . "</td>
        </tr>
    </table>
    <style>
    .impressao tr td {
        padding: 5px 15px;
    }
    </style>

";
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