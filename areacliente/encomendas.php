<?php
// session_start();
// $nomeusuario = $_SESSION['nomeusuario'];

include('../conectadb.php');

$sql = "SELECT pro_id, pro_nome, pro_descricao, pro_preco FROM produtos WHERE pro_status = 's'";
$retorno = mysqli_query($link, $sql);
$ativo = "s";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./encomendas.css">
    <title>LISTA PRODUTOS</title>
</head>
<body>

<!-- MONTAR UM HEADER BAR PARA IR PARA VISUALIZAR ITENS -->
    <div class='container'>
       
        <table border="2">
            <tr>
                <th>NOME</th>
                <th>QUANTIDADE</th>
                <th>PREÇO</th>
                <th>ADD NO PEDIDO</th>
            </tr>
            <!-- TRAZENDO DADOS DA TABELA -->
        <?php
            while($tbl = mysqli_fetch_array($retorno)){
            ?>
        <tr>
            <td><?=$tbl[1]?></td> <!--COLETA NOME DA QUERY-->
            <td><?=$tbl[2]?></td> <!--COLETA DESCRICAO-->
            <td><input type = "number" value="0"></td> <!-- COLETA QUANTIDADE --> 
            <td><?=number_format($tbl[3], 2,',','.')?></td>
            <td><a href="additem.php?id=<?=$tbl[0] ?>"><input type="button" value="ADD ITEM"></td>
        </tr>
        <?php
            }
        ?>
        </table>
    </div>
    
</body>
</html>