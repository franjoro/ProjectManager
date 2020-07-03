<?php
require_once("../conexion.php");
$sql = "INSERT INTO tb_proyectos(name,cliente,propiedad,suiteNumber, notes, datestart,dateend, invoiceCode) 
VALUES('".$_POST['name']."','".$_POST['client']."' ,'".$_POST['ProyectoSelectPropiedades']."' ,'".$_POST['suite']."','".$_POST['notes']."' ,'".$_POST['start']."','".$_POST['end']."'  ,'".$_POST['invoice']."') ";
if($query =mysqli_query($mysqli,$sql )){
   echo mysqli_insert_id($mysqli);;
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
}
mysqli_close($mysqli);
?>