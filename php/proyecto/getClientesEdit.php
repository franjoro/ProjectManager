<?php
require_once("../conexion.php");
$sql = "SELECT code, name FROM tb_clientes WHERE code !='0' ";
$query = mysqli_query($mysqli, $sql);
$json = [] ;
while ($row = mysqli_fetch_array($query)) {
    $json += [$row[0] =>  $row[1] ];
}
echo json_encode($json);
