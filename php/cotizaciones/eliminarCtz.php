<?php
require_once("../conexion.php");
$id = $_GET['id'];

$sql = "DELETE FROM tb_cotizaciones WHERE code='".$id."'";

$query= mysqli_query($mysqli,$sql);

if($query){
    echo mysqli_insert_id($mysqli);
}else{
    echo mysqli_error($mysqli);
}

mysqli_close($mysqli)
?>
