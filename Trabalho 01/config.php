<?php
$con = mysqli_connect('localhost','root','');
$db = mysqli_select_db($con, 'sistema_servicos');
// $db = mysqli_select_db($con, 'usuario');

if(!$con || !$db)
{
	echo "<pre>";
	echo mysqli_error($con);
	echo "</pre>";
}
?>