<?php
#LOCALIZA PC COM BANCO(NOME DO COMPUTADOR)
$servidor = "127.0.0.1";
#NOME DO BANCO
$banco = "saguadim";
#USUARIO DE ACESSO
$usuario = "root";
#SENHA DO USUARIO
$senha = "";
#LINK DE ACESSO
$link = mysqli_connect($servidor, $usuario, $senha, $banco);

?>