<?php
require_once("../conexion.php");
$id = $_GET['id'];

$sql = "DELETE FROM tb_bill WHERE code='".$id."'";
$query= mysqli_query($mysqli,$sql);
    echo mysqli_error($mysqli);
    
mysqli_close($mysqli)
?>
