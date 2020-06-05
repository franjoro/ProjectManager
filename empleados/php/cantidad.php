<?php 
session_start();
require_once("../../php/conexion.php");
$idEmpleado = $_SESSION['code'];
$date = $_GET['date'];

$sql = "SELECT tb_labor.code, tb_labor.codeEmpleado , tb_labor.dateDay, tb_labor.startime , tb_labor.endtime , tb_labor.totalhoras, tb_labor.status, tb_proyectos.name FROM `tb_labor` INNER JOIN tb_proyectos ON tb_labor.codeProyecto = tb_proyectos.code WHERE codeEmpleado='" . $idEmpleado . "' AND dateDay='" . $date . "' ";
$query = mysqli_query($mysqli, $sql);
$numeroDeFilas =  mysqli_num_rows($query);

if ($numeroDeFilas == 0) { 
     $arr = array('num' => $numeroDeFilas , 'data' => false );
     echo json_encode($arr);
}else{
    $datos = [];
    $i = 0;
    while($row = mysqli_fetch_assoc($query)){
        $datos[$i] = $row;
        $i++;
    }
    $arr = array('num' => $numeroDeFilas , 'data' => $datos );
    echo json_encode($arr);
}
mysqli_close($mysqli);
?>