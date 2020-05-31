<?php
require_once("../conexion.php");
$sql = "INSERT INTO tb_providers(name,acct,store,mgr,tel,paymethod,notes) 
VALUES('".$_POST['name']."','".$_POST['acct']."' ,'".$_POST['store']."' ,'".$_POST['mgr']."','".$_POST['tel']."' ,'".$_POST['pay']."','".$_POST['notes']." ') ";
if($query =mysqli_query($mysqli,$sql )){
   echo true;
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
}
mysqli_close($mysqli);
?>