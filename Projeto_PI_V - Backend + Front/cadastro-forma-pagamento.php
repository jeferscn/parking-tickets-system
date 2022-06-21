
<html lang="pt-br">
<head>
    <?php
    include('db/config.php');
    include('sidebar.php');
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    if (@$_SESSION["nivel_usuario"] != "Administrador") echo "<script>alert('Você não tem permissão para acessar esta página!');top.location.href='index.php';</script>";
    ?>
    <link rel="stylesheet" href="css/pagamento.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <?php

    if (@$_REQUEST['botao'] == "Gravar") {
        $verifica_categoria = "SELECT * FROM formas_pagamento WHERE tipo_pagamento='{$_REQUEST['tipo_pagamento']}'";
        $result_verifica_registro = mysqli_query($con, $verifica_categoria);

        if (!$_REQUEST['id_pagamento']) {
            if (mysqli_num_rows($result_verifica_registro) > 0) {
                echo "<script>alert('Esta forma de pagamento já existe!');</script>";
                echo mysqli_error($con);
            } else {
                $insere = "INSERT into formas_pagamento (tipo_pagamento) VALUES ('{$_POST['tipo_pagamento']}')";
                $result_insere = mysqli_query($con, $insere);
                echo "<script>alert('Forma de pagamento criado com sucesso!');top.location.href='cadastro-forma-pagamento.php';</script>";
            }
        } else {
            $insere = "UPDATE formas_pagamento SET 
                tipo_pagamento = '{$_POST['tipo_pagamento']}'
                WHERE id_pagamento = '{$_REQUEST['id_pagamento']}'";
            $result_update = mysqli_query($con, $insere);
            if ($result_update) {
                echo "<script>alert('Forma de pagamento atualizado com sucesso!');top.location.href='cadastro-forma-pagamento.php';</script>";
            } else {
                echo "<script>alert('Não foi possível atualizar!');top.location.href='cadastro-forma-pagamento.php';</script>";
            }
        }
    }
    if (@$_REQUEST['botao'] == "Excluir") {
        $selected_pagamento = $_POST['selected_pagamento'];

        if (!empty($selected_pagamento)) {
            $query_excluir = "DELETE FROM formas_pagamento WHERE tipo_pagamento='$selected_pagamento'";
            $result_update = mysqli_query($con, $query_excluir);
            if ($result_update) {
                echo "<script>alert('Forma de pagamento excluída com sucesso!');top.location.href='cadastro-forma-pagamento.php';</script>";
            } else {
                echo "<script>alert('Não foi possível excluir!');top.location.href='cadastro-forma-pagamento.php';</script>";
            }
        } else {
            echo "<script>alert('Você precisa selecionar uma forma de pagamento!');</script>";
        }
    }
    ?>
    <main>
        <div class="titulo">
            <h1>Cadastrar Pagamento</h1>
        </div>
        <form class="form" action="cadastro-forma-pagamento.php" method="POST" name="categoria">
            <div class="container-dados-config">
                <table align="center">
                    <tr>
                        <td colspan="2">
                            Forma de pagamento:
                            <br>
                            <input type="text" name="tipo_pagamento" placeholder="Ex.: Cartão Débito" value="<?php echo @$_POST['tipo_pagamento']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <button class="submit-button" type="submit" value="Gravar" name="botao">Gravar</button>
                        </td>
                    </tr>
                    <!-- EXCLUIR -->
                    <tr>
                        <td colspan="2">
                            Excluir forma de pagamento:
                                <br>
                                <select name="selected_pagamento">
                                <option value="">Selecionar forma de pagamento</option>
                                <?php
                                $query = "SELECT * FROM formas_pagamento ORDER BY tipo_pagamento";
                                $result_query = mysqli_query($con, $query);
                                while ($query = mysqli_fetch_assoc($result_query)) { ?>
                                    <option value="<?php echo $query['tipo_pagamento']; ?>">
                                        <?php echo $query['tipo_pagamento'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                        <tr>
                            <td colspan="2">
                                <button class="botao-excluir" type="submit" value="Excluir" name="botao">Excluir</button>
                                <input type="hidden" name="id_pagamento" value="<?php echo @$_REQUEST['id_pagamento'] ?>" />
                            </td>
                        </tr>
                    </tr>
                </table>
                <!-- <div class="dados-config">   
                    <label for="">Forma de pagamento:</label>
                    <input type="text" name="tipo_pagamento" placeholder="Ex.: Cartão Débito" value="<?php echo @$_POST['tipo_pagamento']; ?>">

                    <div class="btn-container">
                        <button class="submit-button" type="submit" value="Gravar" name="botao">Gravar</button>
                        <input type="hidden" name="id_pagamento" value="<?php echo @$_REQUEST['id_pagamento'] ?>" />
                    </div>
                </div>
                <div class="dados-config">
                    <label for="">Excluir forma de pagamento:</label>
                    <select name="selected_pagamento">
                        <option value="">Selecionar forma de pagamento</option>
                        <?php
                        $query = "SELECT * FROM formas_pagamento ORDER BY tipo_pagamento";
                        $result_query = mysqli_query($con, $query);
                        while ($query = mysqli_fetch_assoc($result_query)) { ?>
                            <option value="<?php echo $query['tipo_pagamento']; ?>">
                                <?php echo $query['tipo_pagamento'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="btn-container">
                        <button class="botao-excluir" type="submit" value="Excluir" name="botao">Excluir</button>
                        <input type="hidden" name="id_pagamento" value="<?php echo @$_REQUEST['id_pagamento'] ?>" />
                    </div>  
                </div>           -->
            </div>
        </form>
    </main>
</body>

</html>