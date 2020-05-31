<?php
require_once("../conexion.php");
$sql = "INSERT INTO tb_propiedades(name,address,owner,telmgr,notes) 
VALUES('".$_POST['name']."','".$_POST['address']."' ,'".$_POST['owner']."' ,'".$_POST['telmgr']."','".$_POST['notes']." ') ";
if($query =mysqli_query($mysqli,$sql )){
   echo true;
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
}
mysqli_close($mysqli);
?>