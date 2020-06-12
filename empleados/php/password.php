<?php
require_once("../../php/conexion.php");
$id = $_GET['id'];
$sql = "SELECT tb_users.user FROM tb_users INNER JOIN tb_empleados ON tb_users.code = tb_empleados.userpinid WHERE tb_empleados.code = '".$id."' ";
$query= mysqli_query($mysqli,$sql);
$row = mysqli_fetch_array($query);

if (isset($_GET['FromEmpleado'])) {
    $newPass = md5($_GET['FromEmpleado']);
} else {
    $newPass = md5($row[0]);
}

$sql = "UPDATE tb_users SET pass='".$newPass."' WHERE user='".$row[0]."'";
$query= mysqli_query($mysqli, $sql);

echo mysqli_error($mysqli);
?>