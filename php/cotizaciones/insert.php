<?php
require_once("../conexion.php");



$id;
if($_GET['proyectoId'] == 0 ){
    $sql = "INSERT INTO tb_proyectos(name,cliente,propiedad) VALUES('". $_GET['NewP']."', '".$_GET['NewCliente']."','0' )  ";
    $query = mysqli_query($mysqli,$sql);
    $id = mysqli_insert_id($mysqli);
    
$numWorksPeC = json_decode($_GET['arreglo']); // Arreglo de numero de trabajos por cantidad de contador
$contador = $_GET['contador']; // Contador cantidad de categorias por guardar

$place = $_POST['place']; //zona de trabajo Single String
$precio = $_POST['price']; //Precio de las zonas Arreglo
$type = $_POST['type']; // Categoria de trabajo Arreglo
$work = $_POST['work']; // Trabajos Arreglo
//Funcion para sacar precio total
$valorInicial = 0; // Valor inicial de array_reduce
$suma = array_reduce($precio, function ($acarreo, $numero) {
    return $acarreo + $numero;
}, $valorInicial);
// Ingresar WorkZone
$sql="INSERT INTO tb_workzone(codeProyecto,workZone,total) VALUES('".$id."', '".$place."', '".$suma."' ) " ;
$query = mysqli_query($mysqli, $sql);
$workZoneid = mysqli_insert_id($mysqli);
    $n = 0;
    //Ingresar Categorias de trabajo enlazadas al workZone y al proyecto
for ($i=0; $i < $contador; $i++) {
    $sql="INSERT INTO tb_workc(codeZone,category,total) VALUES('".$workZoneid."', '".$type[$i]."', '".$precio[$i]."' ) " ;
    $query = mysqli_query($mysqli, $sql);
    $workCategoryid = mysqli_insert_id($mysqli);
    //Ingresar trabajos enlazados a la categoria de trabajo
    for ($y=0; $y < $numWorksPeC[$i] ; $y++) {
        $sql="INSERT INTO tb_cotizaciones(descripcion,codeWorkC) VALUES('".$work[$n]."','".$workCategoryid."' ) " ;
        $query = mysqli_query($mysqli, $sql);
        $n++;
    }
}

}else{
    
$numWorksPeC = json_decode($_GET['arreglo']); // Arreglo de numero de trabajos por cantidad de contador
$contador = $_GET['contador']; // Contador cantidad de categorias por guardar

$place = $_POST['place']; //zona de trabajo Single String
$precio = $_POST['price']; //Precio de las zonas Arreglo
$type = $_POST['type']; // Categoria de trabajo Arreglo
$work = $_POST['work']; // Trabajos Arreglo
//Funcion para sacar precio total
$valorInicial = 0; // Valor inicial de array_reduce
$suma = array_reduce($precio, function ($acarreo, $numero) {
    return $acarreo + $numero;
}, $valorInicial);
// Ingresar WorkZone
$sql="INSERT INTO tb_workzone(codeProyecto,workZone,total) VALUES('".$_GET['proyectoId']."', '".$place."', '".$suma."' ) " ;
$query = mysqli_query($mysqli, $sql);
$workZoneid = mysqli_insert_id($mysqli);
    $n = 0;
    //Ingresar Categorias de trabajo enlazadas al workZone y al proyecto
for ($i=0; $i < $contador; $i++) {
    $sql="INSERT INTO tb_workc(codeZone,category,total) VALUES('".$workZoneid."', '".$type[$i]."', '".$precio[$i]."' ) " ;
    $query = mysqli_query($mysqli, $sql);
    $workCategoryid = mysqli_insert_id($mysqli);
    //Ingresar trabajos enlazados a la categoria de trabajo
    for ($y=0; $y < $numWorksPeC[$i] ; $y++) {
        $sql="INSERT INTO tb_cotizaciones(descripcion,codeWorkC) VALUES('".$work[$n]."','".$workCategoryid."' ) " ;
        $query = mysqli_query($mysqli, $sql);
        $n++;
    }
}

}







echo mysqli_error($mysqli);

mysqli_close($mysqli);