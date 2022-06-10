
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
        $verifica_categoria = "SELECT * FROM categorias WHERE nome_categoria='{$_REQUEST['categoria']}'";
        $result_verifica_registro = mysqli_query($con, $verifica_categoria);

        if (!$_REQUEST['id_categoria']) {
            if (mysqli_num_rows($result_verifica_registro) > 0) {
                echo "<script>alert('Esta categoria já existe!');</script>";
                echo mysqli_error($con);
            } else {
                $insere = "INSERT into categorias (nome_categoria) VALUES ('{$_POST['categoria']}')";
                $result_insere = mysqli_query($con, $insere);
                echo "<script>alert('Categoria criado com sucesso!');top.location.href='cadastro-categoria.php';</script>";
            }
        } else {
            $insere = "UPDATE categorias SET 
                nome_categoria = '{$_POST['categoria']}'
                WHERE id = '{$_REQUEST['id_categoria']}'";
            $result_update = mysqli_query($con, $insere);
            if ($result_update) {
                echo "<script>alert('Categoria atualizado com sucesso!');top.location.href='cadastro-categoria.php';</script>";
            } else {
                echo "<script>alert('Não foi possível atualizar!');top.location.href='cadastro-categoria.php';</script>";
            }
        }
    }
    if (@$_REQUEST['botao'] == "Excluir") {
        $selected_categoria = $_POST['selected_categoria'];

        if (!empty($selected_categoria)) {
            $query_excluir = "DELETE FROM categorias WHERE nome_categoria='$selected_categoria'";
            $result_update = mysqli_query($con, $query_excluir);
            if ($result_update) {
                echo "<script>alert('Categoria excluída com sucesso!');top.location.href='cadastro-categoria.php';</script>";
            } else {
                echo "<script>alert('Não foi possível excluir!');top.location.href='cadastro-categoria.php';</script>";
            }
        } else {
            echo "<script>alert('Você precisa selecionar uma categoria!');</script>";
        }
    }
    ?>
        <form class="form" action="cadastro-categoria.php" method="POST" name="categoria">
            <table width="20%" align="center">
                <tr>
                    <td colspan="3">
                        <p align="center">Cadastrar categoria</p>
                    </td>
                </tr>

                <tr>
                    <td>Categoria:</td>
                    <td colspan="3">
                        <input type="text" name="categoria" placeholder="Categoria" value="<?php echo @$_POST['categoria']; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <input class="submit-button" type="submit" value="Gravar" name="botao">
                        <input type="hidden" name="id_categoria" value="<?php echo @$_REQUEST['id_categoria'] ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p align="center">Excluir categoria</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <select name="selected_categoria">
                            <option value="">Selecionar categoria</option>
                            <?php
                            $result_usuarios = "SELECT * FROM categorias ORDER BY nome_categoria";
                            $result_verifica_usuarios = mysqli_query($con, $result_usuarios);
                            while ($result_usuarios = mysqli_fetch_assoc($result_verifica_usuarios)) { ?>
                                <option value="<?php echo $result_usuarios['nome_categoria']; ?>">
                                    <?php echo $result_usuarios['nome_categoria'] ?>
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
                        <input type="hidden" name="id_categoria" value="<?php echo @$_REQUEST['id_categoria'] ?>" />
                    </td>
                    </td>
                </tr>
            </table>
        </form>
</body>

</html>