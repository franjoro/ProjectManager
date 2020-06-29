<?php require_once("../../php/conexion.php");
$sql= "SELECT code, name FROM tb_proyectos WHERE status = '0'";
$query = mysqli_query($mysqli, $sql);
$array = [];

while ($row = mysqli_fetch_array($query)) {
   $array += [ $row[0] => $row[1] ];
}
$arr  = json_encode($array);
echo $arr;
mysqli_close($mysqli);
?>