<?php
$cliente = $_GET['cliente'];
require_once("../conexion.php");
$sql = "SELECT workZone, total,code FROM tb_workzone WHERE codeProyecto='".$cliente."' ";
$query = mysqli_query($mysqli, $sql);


$columns = array();

while ($row = mysqli_fetch_array($query)) {
    $columns[] =   array('WorkZone' => $row[0], 'total'=> number_format($row[1],2), 'code'=>$row[2] );
    
}
header('Content-Type: application/json');
echo json_encode($columns);



echo mysqli_error($mysqli);
mysqli_close($mysqli);
