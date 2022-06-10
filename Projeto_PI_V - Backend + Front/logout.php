<?php

session_start(); //iniciamos a sess�o que foi aberta
session_unset(); //limpamos as variaveis globais das sess�es
session_destroy(); //pei!!! destruimos a sess�o ;)

echo "<script>top.location.href='index.php';</script>"; /*aqui voc� pode por alguma coisa falando que ele saiu ou fazer como eu, coloquei redirecionar para uma certa p�gina*/
?>