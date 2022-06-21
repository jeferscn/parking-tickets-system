<head>
    <?php
    include('db/config.php');
    include('sidebar.php');
    if (!isset($_SESSION)) {
        session_start();
    }
    if (@$_SESSION["nivel_usuario"] != "Administrador") echo "<script>alert('Você não tem permissão para acessar esta página!');top.location.href='index.php';</script>";
    ?>
    <link rel="stylesheet" href="css/configuracoes.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <?php

    //Recupera informações para mostrar ao usuário
    $query = "SELECT * FROM configuracoes WHERE id='1'";
    $execute = mysqli_query($con, $query);
    while ($query = mysqli_fetch_assoc($execute)) {
        $total_vagas = $query['total_vagas'];
        $valor_pequeno = $query['valor_pequeno'];
        $valor_medio = $query['valor_medio'];
        $valor_grande = $query['valor_grande'];
        @$tempo_isencao = $query['tempo_isencao'];
        $nome_estacionamento = $query['nome_estacionamento'];
        $mensagem = $query['mensagem'];
        $endereco = $query['endereco'];
        $telefone = $query['telefone'];
    }

    // Atualiza informações
    if (@$_REQUEST['botao'] == "Gravar") {
        $insere = "UPDATE configuracoes SET
                total_vagas = '{$_POST['total_vagas']}',
                valor_pequeno = '{$_POST['valor_pequeno']}',
                valor_medio = '{$_POST['valor_medio']}',
                valor_grande = '{$_POST['valor_grande']}',
                tempo_isencao = '{$_POST['tempo_isencao']}',
                nome_estacionamento = '{$_POST['nome_estacionamento']}',
                mensagem = '{$_POST['mensagem']}',
                endereco = '{$_POST['endereco']}',
                telefone = '{$_POST['telefone']}'
                WHERE id = '1'";
        $result_update = mysqli_query($con, $insere);
        if ($result_update) {
            echo "<script>alert('Configurações atualizadas com sucesso!');top.location.href='configuracoes.php';</script>";
        } else {
            echo "<script>alert('Não foi possível atualizar!');top.location.href='configuracoes.php';</script>";
        }
    }

    ?>
    <main>
        <div class="titulo">
            <h1>Configurações</h1>
        </div>
        <form action="configuracoes.php" method="POST">
            <div class="container-dados-config">
                <table width="20%" align="center">
                    <tr>
                        <td colspan="2" align="center">
                            Total de vagas
                            <br>
                            <input type="number" size="40" min="0" name="total_vagas" onKeyUp="mascaraRemoveCaracteresEspeciais(this, event)" required placeholder="Número de vagas" value="<?php echo @$total_vagas; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            Valor veículo pequeno
                            <br>
                            <input type="text" name="valor_pequeno" onKeyUp="mascaraMoeda(this, event)" required placeholder="Ex.: 3,50" value="<?php echo str_replace(".", ",", @$valor_pequeno); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            Valor veículo médio
                            <br>
                            <input type="text" name="valor_medio" onKeyUp="mascaraMoeda(this, event)" required placeholder="Ex.: 4,50" value="<?php echo str_replace(".", ",", @$valor_medio); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            Valor veículo grande
                            <br>
                            <input type="text" name="valor_grande" onKeyUp="mascaraMoeda(this, event)" required placeholder="Ex.: 5,50" value="<?php echo str_replace(".", ",", @$valor_grande); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            Tempo de tolerância em minutos
                            <br>
                            <input type="number" min="0" name="tempo_isencao" required placeholder="Ex.: 15" value="<?php echo @$tempo_isencao; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            Nome do estacionamento
                            <br>
                            <input type="text" name="nome_estacionamento" required placeholder="Ex.: Estacionamento Parking Place" value="<?php echo @$nome_estacionamento; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            Endereço
                            <br>
                            <input type="text" name="endereco" required placeholder="Ex.: Rua XV de Novembro, 1160 - Curitiba/PR" value="<?php echo @$endereco; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            Mensagem no ticket
                            <br>
                            <input type="text" name="mensagem" required placeholder="Ex.: Obrigado por confiar em nossos serviços! :)" value="<?php echo @$mensagem; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            Telefone
                            <br>
                            <input type="text" id="celular" name="telefone" onKeyUp="mascaraTelefone(this)" required placeholder="Ex.: 41988776655" value="<?php echo @$telefone; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <br><br>
                            <button class="btn-gravar" type="submit" value="Gravar" name="botao">Gravar</button>
                            <input type="hidden" name="id_categoria" value="<?php echo @$_REQUEST['id_categoria'] ?>" />
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </main>
</body>

</html>
<script>
    String.prototype.reverse = function() {
        return this.split('').reverse().join('');
    };

    function mascaraMoeda(campo, evento) {
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor = campo.value.replace(/[^\d]+/gi, '').reverse();
        var resultado = "";
        var mascara = "##.###.###,##".reverse();
        for (var x = 0, y = 0; x < mascara.length && y < valor.length;) {
            if (mascara.charAt(x) != '#') {
                resultado += mascara.charAt(x);
                x++;
            } else {
                resultado += valor.charAt(y);
                y++;
                x++;
            }
        }
        campo.value = resultado.reverse();
    }

    function mascaraRemoveCaracteresEspeciais(campo, evento) {
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor = campo.value.replace(/[^\d]+/gi, '').reverse();
        var resultado = "";
        for (var x = 0, y = 0; x < 50 && y < valor.length;) {
            resultado += valor.charAt(y);
            y++;
            x++;
        }
        campo.value = resultado.reverse();
    }


    function mascaraTelefone(campo) {

        function trata(valor, isOnBlur) {
            valor = valor.replace(/\D/g, "");
            valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2");
            if (isOnBlur) {
                valor = valor.replace(/(\d)(\d{4})$/, "$1-$2");
            } else {
                valor = valor.replace(/(\d)(\d{3})$/, "$1-$2");
            }
            return valor;
        }

        campo.onkeypress = function(evt) {
            var code = (window.event) ? window.event.keyCode : evt.which;
            var valor = this.value
            if (code > 57 || (code < 48 && code != 8)) {
                return false;
            } else {
                this.value = trata(valor, false);
            }
        }

        campo.onblur = function() {

            var valor = this.value;
            if (valor.length < 14) {
                this.value = "Número Inválido"
            } else {
                this.value = trata(this.value, true);
            }
        }

        campo.maxLength = 15;
    }
    mascaraTelefone(document.getElementById('campaign_telefone_campaign_user'));
</script>