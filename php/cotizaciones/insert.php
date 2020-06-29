<?php
require_once("../conexion.php");
$numWorksPeC = json_decode($_GET['arreglo']); // Arreglo de numero de trabajos por cantidad de contador
$contador = $_GET['contador']; // Contador cantidad de categorias por guardar


$proyectoId = $_GET['proyectoId']; // Id proyecto seleccionado
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
$sql="INSERT INTO tb_workzone(codeProyecto,workZone,total) VALUES('".$proyectoId."', '".$place."', '".$suma."' ) " ;
$query = mysqli_query($mysqli,$sql);
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






// $cantidad = $_POST['cantidad']; //arreglo
// $concepto = $_POST['concepto']; //arreglo
// $precio = $_POST['precio']; //arreglo
// $total = $_POST['total']; //arreglo
// $ProyectName = $_GET['generico']; //single
// $cliente = $_GET['cliente']; //single




// if($proyectoId == 0 ){
//     $sql = "INSERT INTO tb_proyectos(name,cliente,propiedad) VALUES('". $ProyectName."', '$cliente','0' )  ";
//     $query = mysqli_query($mysqli,$sql);
//     $id = mysqli_insert_id($mysqli);
//     for ($i = 0; $i < $c; $i++) {
//         $sql = "INSERT INTO tb_cotizaciones(projectCode,descripcion,cantidad,costo,total) VALUES('" . $id . "' , '" . $concepto[$i] . "' , '" . $cantidad[$i] . "' , '" . $precio[$i] . "' , '" . $total[$i] . "') ";
//         $query = mysqli_query($mysqli, $sql);
//     }
// }else {
//     for ($i = 0; $i < $c; $i++) {
//         $sql = "INSERT INTO tb_cotizaciones(projectCode,descripcion,cantidad,costo,total) VALUES('" . $proyectoId . "' ,'" . $concepto[$i] . "' , '" . $cantidad[$i] . "' , '" . $precio[$i] . "' , '" . $total[$i] . "') ";
//         $query = mysqli_query($mysqli, $sql);
//     }
// }

// if($query){
//     echo "Que pro soy, si funciona yeih :D";
// }else{
    echo mysqli_error($mysqli);
// }
// mysqli_close($mysqli);
