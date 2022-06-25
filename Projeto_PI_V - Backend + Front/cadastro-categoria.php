
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
    <link rel="stylesheet" href="css/categoria.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
    <main>
        <div class="titulo">
            <h1>Cadastrar Categoria</h1>
        </div>
        <div class="container-dados-config">
            <form class="form" action="cadastro-categoria.php" method="POST" name="categoria">
                <table width="20%" align="center">
                    <tr>
                        <td colspan="2">
                            Categoria:
                            <input type="text" name="categoria" placeholder="Categoria" value="<?php echo @$_POST['categoria']; ?>">
                            <button class="submit-button" type="submit" value="Gravar" name="botao">Gravar</button>
                            <input type="hidden" name="id_categoria" value="<?php echo @$_REQUEST['id_categoria'] ?>" />
                        </td>
                    </tr>
                </table>
                <table width="20%" align="center">
                    <tr>
                        <td colspan="2">
                            Excluir categoria:
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
                            <button class="botao-excluir" type="submit" value="Excluir" name="botao">Excluir</button>
                            <input type="hidden" name="id_categoria" value="<?php echo @$_REQUEST['id_categoria'] ?>" />
                        </td>
                    </tr>
                </table>
                <!-- <div class="dados-config">
                    <div class="container-categoria">
                        <label for="">Categoria:</label>
                        <input type="text" name="categoria" placeholder="Categoria" value="<?php echo @$_POST['categoria']; ?>">
                    </div>
                    
                    <div class="btn-container">
                        <button class="submit-button" type="submit" value="Gravar" name="botao">Gravar</button>
                        <input type="hidden" name="id_categoria" value="<?php echo @$_REQUEST['id_categoria'] ?>" />
                    </div>
                </div> -->

                <!-- <div class="dados-config">
                    <div class="container-categoria">
                        <label for="">Excluir categoria:</label>
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
                    </div>

                    <div class="btn-container">
                        <button class="botao-excluir" type="submit" value="Excluir" name="botao">Excluir</button>
                        <input type="hidden" name="id_categoria" value="<?php echo @$_REQUEST['id_categoria'] ?>" />
                    </div>
                </div> -->
            </form>
        </div>
    </main>

</body>

</html>