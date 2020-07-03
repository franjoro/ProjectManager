<?php
require('../conexion.php');
$cliente = $_GET['cliente'];
$sql = "SELECT tb_workc.category, tb_workc.total, tb_cotizaciones.descripcion FROM `tb_workc` INNER JOIN tb_cotizaciones ON tb_workc.code = tb_cotizaciones.codeWorkC WHERE tb_workc.codeZone ='".$cliente."' ";
$query = mysqli_query($mysqli, $sql);

$json = array();


while ($row = mysqli_fetch_array($query)) {
    
    $json[]= array('cat'=>$row[0], 'total'=> number_format($row[1],2), 'detalle'=>$row[2] );
}
echo json_encode($json);
echo mysqli_error($mysqli);
mysqli_close($mysqli);
