<?php
#INICIA VARIAVEL DE SESSAO
session_start();

#INCLUI CODIGO DE CONEXÃO DO BANCO
include("conectadb.php");

#APÓS CLICK NO FORM POST
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    #QUERY DE VALIDA SE USUARIO EXISTE
    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_email = '$email' AND usu_senha = '$senha' AND usu_status = 's'";
    $retorno = mysqli_query($link, $sql);
    
    #SUGESTÃO ARIEL DE SANITIZAÇÃO
    $retorno = mysqli_fetch_array($retorno) [0];

    ##GRAVA LOG
    $sql ='"'.$sql.'"';
    $sqllog ="INSERT INTO tab_log (tab_query, tab_data)
    VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);

    #SE USUARIO NÃO EXISTE LOGA, SE NÃO, NÃO LOGA
    if ($retorno == 0){
        echo"<script>window.alert('USUARIO INCORRETO');</script>";
        echo"<script>window.location.href='login.html';</script>";

    }
    else{
        $sql = "SELECT * FROM usuarios 
        WHERE usu_email = '$email'
        AND usu_senha = '$senha'
        AND usu_status = 's'";
    $retorno = mysqli_query($link,$sql);
    ##GRAVA LOG
    $sql ='"'.$sql.'"';
    $sqllog ="INSERT INTO tab_log (tab_query, tab_data)
    VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);

    while($tbl = mysqli_fetch_array($retorno)){
        $_SESSION['idusuario'] = $tbl[0];
        $_SESSION['nomeusuario'] = $tbl[1];
    }
        echo"<script>window.location.href='backoffice.php';</script>";
    }

}

?>