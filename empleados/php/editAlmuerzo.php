<?php
require_once("../../php/conexion.php");
$columna1  = $_POST['columna1'];
$columna2  = $_POST['columna2'];
$campo = $_POST['campo'] ;
$code = $_POST['code'] ;
$sql ="UPDATE tb_labor SET ".$columna2." = '".$campo."' , ".$columna1." = '1'  WHERE code='".$code."' ";
$query = mysqli_query($mysqli, $sql);
echo mysqli_error($mysqli);
mysqli_close($mysqli);
