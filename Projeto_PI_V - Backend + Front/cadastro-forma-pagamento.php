
<html lang="pt-br">
<head>
    <?php include('db/config.php');
    session_start();
    if (@$_SESSION["nivel_usuario"] != "Administrador") echo "<script>alert('Você não tem permissão para acessar esta página!');top.location.href='index.php';</script>";
    ?>
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
        <form class="form" action="cadastro-forma-pagamento.php" method="POST" name="categoria">
            <table width="20%" align="center">
                <tr>
                    <td colspan="3">
                        <p align="center">Cadastrar forma de pagamento</p>
                    </td>
                </tr>

                <tr>
                    <td>Forma de pagamento:</td>
                    <td colspan="3">
                        <input type="text" name="tipo_pagamento" placeholder="Ex.: Cartão Débito" value="<?php echo @$_POST['tipo_pagamento']; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <input class="submit-button" type="submit" value="Gravar" name="botao">
                        <input type="hidden" name="id_pagamento" value="<?php echo @$_REQUEST['id_pagamento'] ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p align="center">Excluir forma de pagamento</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
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
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <input class="botao-excluir" type="submit" value="Excluir" name="botao">
                        <input type="hidden" name="id_pagamento" value="<?php echo @$_REQUEST['id_pagamento'] ?>" />
                    </td>
                    </td>
                </tr>
            </table>
        </form>
</body>

</html>