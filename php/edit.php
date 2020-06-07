<?php
require_once('conexion.php');
$tabla   = $_POST['tabla'];
$columna  = $_POST['columna'];
$campo = $_POST['campo'] ;
$code = $_POST['code'] ;
$sql ="UPDATE ".$tabla." SET ".$columna." = '".$campo."' WHERE code='".$code."' ";
$query = mysqli_query($mysqli, $sql); 
echo mysqli_error($mysqli);
mysqli_close($mysqli);
?>