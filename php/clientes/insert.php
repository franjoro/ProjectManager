<?php
require_once("../conexion.php");
$sql = "INSERT INTO tb_clientes(name,address,contact,teloffice,telcel,telother,email,notes) 
VALUES('".$_POST['name']."','".$_POST['address']."' ,'".$_POST['contact']."' ,'".$_POST['phoneOf']."' ,'".$_POST['phoneCel']." ','".$_POST['PhoneOth']."' ,'".$_POST['email']." ','".$_POST['notes']." ') ";
if($query =mysqli_query($mysqli,$sql )){
   echo true;
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
}
mysqli_close($mysqli);
?>