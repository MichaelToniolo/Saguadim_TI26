<?php
session_start();

include("conectadb.php");

if($_SERVER['REQUEST_METHOD']=='POST'){
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT COUNT(usu_id) FROM usuarios 
        WHERE usu_login = '$login' 
        AND usu_senha = '$senha' AND usu_status = 's'";
    ##GRAVA LOG
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data)
        VALUES ('$sql', NOW())";
    mysqli_query($link, $sqllog);
    $retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $resultado = $tbl[0];
    }

    if ($resultado == 0){
        echo"<script>window.alert('USUARIO INCORRETO');</script>";
    }
    else{
        $sql = "SELECT * FROM usuarios 
        WHERE usu_login = '$login'
        AND usu_senha = '$senha'
        AND usu_status = 's'";
    $retorno = mysqli_query($link,$sql);
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data)
        VALUES ('$sql', NOW())";
    mysqli_query($link, $sqllog);   

    while($tbl = mysqli_fetch_array($retorno)){
        $_SESSION['idusuario'] = $tbl[0];
        $_SESSION['nomeusuario'] = $tbl[1];
    }
        echo"<script>window.location.href='backoffice.php';</script>";
    }

}

?>