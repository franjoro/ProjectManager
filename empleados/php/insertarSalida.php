<?php
session_start();
require_once("../../php/conexion.php");
$code= $_POST['code'];
$salida = $_POST['salida'];
$horas= $_POST['horas'];


$sql="UPDATE tb_labor SET endtime='".$salida."', status='1' , totalhoras='".$horas."' WHERE code='".$code."'   ";
$query = mysqli_query($mysqli, $sql);
echo mysqli_error($mysqli);
mysqli_close($mysqli);
