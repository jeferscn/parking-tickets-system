<?php
include ('config.php');
session_start(); // inicia a sessao	


if (@$_REQUEST['botao'] == "Entrar")
{
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
	$query = "SELECT * FROM clientes WHERE login = '$login' AND senha = '$senha' ";
	$result = mysqli_query($con, $query);
	while ($coluna=mysqli_fetch_array($result)) 
	{
		$_SESSION["id_usuario"]= $coluna["id"]; 
		$_SESSION["nome_usuario"] = $coluna["name"]; 
		$_SESSION["UsuarioNivel"] = $coluna["nivel"];

		// caso queira direcionar para páginas diferentes
		$niv = $coluna['nivel'];
		if($niv == "USER"){ 
			header("Location: menu.php"); 
			exit; 
		}
		
		if($niv == "ADM"){ 
			header("Location: menu.php"); 
			exit; 
		}
		// ----------------------------------------------
	}
	
}


?>

<html>
<body>
<form action=# method=post>

Login: <input type=text name=name>
Senha: <input type=text name=senha>
<input type=submit name=botao value=Entrar>

</form>










