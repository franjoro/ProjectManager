<?php 
require_once('conexion.php');
session_start();
$pin=$_POST['pin'];
$pass = md5($_POST['pass']);

$sql = "SELECT COUNT(*) , tb_users.role, tb_empleados.code FROM tb_users  INNER JOIN tb_empleados ON tb_users.code = tb_empleados.userpinid WHERE user='".$pin. "' AND pass='" . $pass . "'  ";
$query = mysqli_query($mysqli, $sql);
$row= mysqli_fetch_array($query);

if($row[0] == 0){
    echo "NotAccess";
}else{
    if($row[1] == 1){
        $_SESSION['pin'] = $pin;
        $_SESSION['code'] = $row[2];
        if(isset($_SESSION['code'])){
            echo "okE";
        }
    }else{
        echo "ok";
    }
}
mysqli_close($mysqli);
?>