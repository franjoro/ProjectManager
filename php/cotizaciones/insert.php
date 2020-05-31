<?php
require_once("../conexion.php");
$cantidad = $_POST['cantidad']; //arreglo
$concepto = $_POST['concepto']; //arreglo
$precio = $_POST['precio']; //arreglo
$total = $_POST['total']; //arreglo
$proyectoId = $_GET['proyectoId'];
$c = $_GET['contador'];
$ProyectName = $_GET['generico']; //single



if($proyectoId == 0 ){
    $sql = "INSERT INTO tb_proyectos(name,cliente,propiedad) VALUES('". $ProyectName."', '0','0' )  ";
    $query = mysqli_query($mysqli,$sql);
    $id = mysqli_insert_id($mysqli);
    for ($i = 0; $i < $c; $i++) {
        $sql = "INSERT INTO tb_cotizaciones(projectCode,descripcion,cantidad,costo,total) VALUES('" . $id . "' , '" . $concepto[$i] . "' , '" . $cantidad[$i] . "' , '" . $precio[$i] . "' , '" . $total[$i] . "') ";
        $query = mysqli_query($mysqli, $sql);
    }
}else {
    for ($i = 0; $i < $c; $i++) {
        $sql = "INSERT INTO tb_cotizaciones(projectCode,descripcion,cantidad,costo,total) VALUES('" . $proyectoId . "' ,'" . $concepto[$i] . "' , '" . $cantidad[$i] . "' , '" . $precio[$i] . "' , '" . $total[$i] . "') ";
        $query = mysqli_query($mysqli, $sql);
    }
}

if($query){
    echo "Que pro soy, si funciona yeih :D";
}else{
    echo " :C ".mysqli_error($mysqli);
}
mysqli_close($mysqli);

?>