<?php
require_once("../conexion.php");
$cliente = $_GET['cliente'];
$sql = "SELECT code, name FROM tb_propiedades WHERE owner ='".$cliente."' ";
$query = mysqli_query($mysqli, $sql);
$json = [] ;
while ($row = mysqli_fetch_array($query)) {
    $json += [$row[0] =>  $row[1] ];
}
echo json_encode($json);
