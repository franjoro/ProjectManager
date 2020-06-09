<?php 
session_start();
require_once("../../php/conexion.php");
$empleado = $_SESSION['user'];
$date = $_GET['date'];
$entrada = $_POST['entrada'];
$selectedProject = $_POST['selectedProject'];
$sql=" INSERT INTO tb_labor(codeEmpleado, dateDay,startime, codeProyecto)  VALUES('".$empleado."','".$date."','".$entrada."','".$selectedProject."') ";
$query = mysqli_query($mysqli,$sql);
echo mysqli_error($mysqli);
mysqli_close($mysqli);
?>