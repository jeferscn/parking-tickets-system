<head>
    <?php include('sidebar.php'); ?>
    <?php include('db/config.php');

    if (@$_SESSION["nivel_usuario"] != "Operador" && @$_SESSION["nivel_usuario"] != "Administrador") {
        echo "<script>alert('Você não tem permissão para acessar esta página!');top.location.href='index.php';</script>";
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/saida.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Saída Veículo</title>
</head>
<?php



// Página para usuário logado
?>

<section id="primeiro-bloco" class="display-column-flex">
<main>

    <?php
    if (empty(@$_GET['veiculo']) && is_null(@$_GET['veiculo'])) {
    ?>
    <div class="titulo">
            <h1>Saída Veículo</h1>
        </div>
        <div class="container-saidas">
        <table class="tabela">
        <form class="form" name="fmrpesquisa" id="frmpesquisa" method="POST">
           
                
            
                <div class="filtro">
                    Filtrar por placa:<input type="text" name="placa" placeholder="Filtrar por placa" value="<?php echo @$_POST['placa'] ?>">
                </div>
                <div class="div-btn-gerar">
                    <input class="btn-gerar" type="submit" name="botao" value="Gerar">
                </div>
            <br>
        </form>
        </table> 

        <form method="post" action="saida-veiculo.php>">
            <table class="tabela" align="CENTER">
                <tr>
                    <!-- <th width="5%">Código</th> -->
                    <th width="10%">Placa</th>
                    <th width="10%">Nome</th>
                    <th width="10%">Categoria</th>
                    <th width="10%">Tamanho</th>
                    <th width="10%">Entrada</th>
                    <th width="10%">Saídas</th>
                </tr>
                <?php
                // Logica Filtros
                // Filtro por nome
                $query = "SELECT * FROM veiculos WHERE estacionado='sim'";
                @$placa = $_POST['placa'];
                if (true) $query .= ($placa ? " AND placa LIKE '%$placa%' " : "");
                $result = mysqli_query($con, $query);
                while ($coluna = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <!-- <td width="5%" align="center"><?php echo $coluna['id_veiculo']; ?></td> -->
                        <td width="10%" align="center"><?php echo $coluna['placa']; ?></td>
                        <td width="10%" align="center"><?php echo $coluna['nome_veiculo']; ?></td>
                        <td width="10%" align="center"><?php echo $coluna['nome_categoria']; ?></td>
                        <td width="10%" align="center"><?php echo $coluna['tamanho']; ?></td>
                        <td width="10%" align="center"><?php $data_entrada = new DateTime($coluna['data_entrada']);
                                                        echo $data_entrada->format('d-m-Y H:i:s') . "<br>"; ?></td>
                        <td width="10%">
                            <a class="cor-link" href="saida-veiculo.php?placa=<?php echo @$coluna['placa']; ?>&veiculo=<?php echo @$coluna['id_veiculo']; ?>">
                                <input class="btn-saida" type="button" value="Saída" />
                            </a>
                        </td>
                    </tr>
                <?php

                } // fim while

            } else {
                // Mostra o veículo para dar saída e forma de pagamento
                ?>

                <form method="post" action="">
                <div class="container-saidas">
                    <table class="tabela-relatorio" align="CENTER">
                        <tr>
                            <th width="5%">Código</th>
                            <th width="10%">Placa</th>
                            <th width="10%">Nome</th>
                            <th width="10%">Categoria</th>
                            <th width="10%">Tamanho</th>
                            <th width="10%">Entrada</th>
                        </tr>
                        <?php
                        // Logica Filtros
                        $veiculo = @$_GET['veiculo'];
                        $placa = @$_REQUEST['placa'];
                        $query = "SELECT * FROM veiculos WHERE estacionado='sim' AND id_veiculo='$veiculo'";

                        // Filtro por nome
                        @$placa = $_POST['placa'];
                        if (true) {
                            $query .= ($placa ? " AND placa LIKE '%$placa%' " : "");
                        }

                        $result = mysqli_query($con, $query);

                        while ($coluna = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td width="5%" align="center"><?php echo $coluna['id_veiculo']; ?></td>
                                <td width="10%" align="center"><?php echo $coluna['placa']; ?></td>
                                <td width="10%" align="center"><?php echo $coluna['nome_veiculo']; ?></td>
                                <td width="10%" align="center"><?php echo $coluna['nome_categoria']; ?></td>
                                <td width="10%" align="center"><?php echo $coluna['tamanho']; ?></td>
                                <td width="10%" align="center"><?php $data_entrada = new DateTime($coluna['data_entrada']);
                                                                echo $data_entrada->format('d-m-Y H:i:s') . "<br>"; ?></td>
                            </tr>
                        <?php
                        } // fim while


                        if (@$_POST['botao'] == "Finalizar") {
                            //Atualiza campo estacionado e pega hora da saida do veículos
                            $query = "UPDATE veiculos SET data_saida = CURRENT_TIMESTAMP(), estacionado = 'nao' WHERE id_veiculo='{$_GET['veiculo']}'";
                            mysqli_query($con, $query);
                            $query = "UPDATE configuracoes SET total_vagas_ocupadas = total_vagas_ocupadas - 1";
                            mysqli_query($con, $query);

                            // pega valores do banco para multiplicar com as horas
                            $query = "SELECT valor_pequeno, valor_medio, valor_grande, tempo_isencao FROM configuracoes WHERE id IS NOT NULL";
                            $result = mysqli_query($con, $query);
                            while ($result_valores = mysqli_fetch_assoc($result)) {
                                $valor_pequeno = $result_valores['valor_pequeno'];
                                $valor_medio = $result_valores['valor_medio'];
                                $valor_grande = $result_valores['valor_grande'];
                                $tempo_isencao = $result_valores['tempo_isencao'];
                            }
                            //seleciona diferença entre datas em minutos
                            $query = "SELECT id_veiculo, placa, tamanho, TIMESTAMPDIFF(MINUTE, data_entrada, data_saida) as total_minutos FROM veiculos WHERE id_veiculo='{$_GET['veiculo']}'";
                            $result = mysqli_query($con, $query);
                            while ($result_valores = mysqli_fetch_assoc($result)) {
                                $id_veiculo = $result_valores['id_veiculo'];
                                $placa = $result_valores['placa'];
                                $tamanho_veiculo = $result_valores['tamanho'];
                                $total_minutos = $result_valores['total_minutos'];
                            }

                            // verifica se isenta o cliente
                            if($total_minutos < $tempo_isencao) $total_minutos = 0;
                            //calcula valor total a pagar de acordo com o tamanho do veículo
                            if ($tamanho_veiculo == "pequeno") $valor_total_a_pagar = ($valor_pequeno / 60) * $total_minutos;
                            elseif ($tamanho_veiculo == "medio") $valor_total_a_pagar = ($valor_medio / 60) * $total_minutos;
                            elseif ($tamanho_veiculo == "grande") $valor_total_a_pagar = ($valor_grande / 60) * $total_minutos;

                            //Insere valor total a pagar na tabela
                            $query = "INSERT INTO pagamentos (valor, tipo_pagamento, id_veiculo, placa) VALUES ('$valor_total_a_pagar', '{$_POST['selected_tipo_pagamento']}', '$id_veiculo', '$placa')";
                            mysqli_query($con, $query);
                            echo "<script>window.open('imprimir.php?veiculo=" . $id_veiculo . "&saida=sim', '_blank');</script>";
                            echo "<script>alert('Finalização realizada com sucesso!');top.location.href='saida-veiculo.php';</script>";
                           
                           
                        }
                        ?>
                        <tr>
                            <td colspan="8" align="center">
                                <select name="selected_tipo_pagamento" required>
                                    <option value="">Selecionar forma de pagamento</option>
                                    <?php
                                    $query = "SELECT * FROM formas_pagamento ORDER BY tipo_pagamento";
                                    $result_query = mysqli_query($con, $query);
                                    while ($result = mysqli_fetch_assoc($result_query)) { ?>
                                        <option value="<?php echo $result['tipo_pagamento']; ?>">
                                            <?php echo $result['tipo_pagamento']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <input class="btn-finalizar" type="submit" name="botao" value="Finalizar">

                            </td>
                        </tr>
                    </table>
                    </div>
                </form>

            <?php
            }
            ?>
             </div>
            </main>
</section>