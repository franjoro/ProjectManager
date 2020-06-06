<?php 
require_once('conexion.php');
session_start();
$pin=$_POST['pin'];
$pass = md5($_POST['pass']);

$sql = "SELECT COUNT(*) , role, code FROM tb_users  WHERE user='".$pin. "' AND pass='" . $pass . "'  ";
$query = mysqli_query($mysqli, $sql);
$row= mysqli_fetch_array($query);

$userpinid = $row[2];

if($row[0] == 0){
    echo "NotAccess";
}else{
    if($row[1] == 1){
        $sql = "SELECT code FROM tb_empleados  WHERE userpinid='".$userpinid."' ";
        $query = mysqli_query($mysqli, $sql);
        $row= mysqli_fetch_array($query);

        $_SESSION['pin'] = $pin;
        $_SESSION['code'] = $row[0];
        if(isset($_SESSION['code'])){
            echo "okE";
        }
    }else{
        $_SESSION['code'] = $pin;
        echo "ok";
    }
}
mysqli_close($mysqli);
?>