<?php 
require_once('conexion.php');

$pin=$_POST['pin'];
$pass = md5($_POST['pass']);

$sql = "SELECT COUNT(*) FROM tb_users WHERE user='".$pin. "' AND pass='" . $pass . "'  ";
$query = mysqli_query($mysqli, $sql);
$row= mysqli_fetch_array($query);

if($row[0] == 0){
    echo "NotAccess";
}else{
    echo "ok";
}
mysqli_close($mysqli);
?>