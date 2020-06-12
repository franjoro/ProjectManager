<?php
require_once("../conexion.php");
$entrada = $_POST['entrada'];
$salida = $_POST['salida'];
$total = $_POST['horas'];
$code = $_POST['code'];
$sql = "UPDATE tb_labor SET startime='".$entrada."', endtime='".$salida."',  totalhoras='".$total."' WHERE code='".$code."'";
$query = mysqli_query($mysqli, $sql);
echo mysqli_error($mysqli);

?>