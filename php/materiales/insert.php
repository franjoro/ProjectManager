<?php
require_once("../conexion.php");
$cantidad = $_POST['cantidad']; //arreglo
$concepto = $_POST['concepto']; //arreglo
$precio = $_POST['precio']; //arreglo
$total = $_POST['total']; //arreglo
$proyectoId = $_GET['proyectoId'];
$proovedores = $_POST['provider']; //single
$billNum = $_POST['bill']; //single
$ProyectName = $_GET['generico']; //single
$date = $_POST['date']; //single
$paym = $_POST['paym']; //single

if (empty($_POST['gst'])) {
    $gst = 0;
} else {
    $gst = $_POST['gst'];
}
if (empty($_POST['pst'])) {
    $pst = 0;
} else {
    $pst = $_POST['pst'];
}


//Verificar si existe proovedor y bill con el mismo nombre
$sql = "SELECT COUNT(*) FROM tb_bill WHERE providerCode='".$proovedores."' AND name='".$billNum."'  ";
$query = mysqli_query($mysqli, $sql);
$validacion = mysqli_fetch_array($query);
if ($validacion[0] >0) {
    echo "billAlreadyExist";
} else {
    $c = $_GET['contador'];


    if ($proyectoId == 0) {
        $sql = "INSERT INTO tb_proyectos(name,cliente,propiedad) VALUES('" . $ProyectName . "', '0','0' )  ";
        $query = mysqli_query($mysqli, $sql);
        $id = mysqli_insert_id($mysqli);

        if (!$query) {
            echo  mysqli_error($mysqli);
        }

        $sql = "INSERT INTO tb_bill(projectCode, providerCode , name, date, paym, GST, PST) VALUES('" . $id . "','" . $proovedores . "','" . $billNum . "','" . $date . "','" . $paym . "','" . $gst . "','" . $pst . "' )  ";
        $consultaBill = mysqli_query($mysqli, $sql);
        $bill = mysqli_insert_id($mysqli);

        if (!$consultaBill) {
            echo mysqli_error($mysqli);
        }
        for ($i = 0; $i < $c; $i++) {
            $sql = "INSERT INTO tb_materiales(Bill,descripcion,cantidad,costo,total) VALUES('" . $bill . "' , '" . $concepto[$i] . "' , '" . $cantidad[$i] . "' , '" . $precio[$i] . "' , '" . $total[$i] . "') ";
            $ConsultaFor1 = mysqli_query($mysqli, $sql);
        }

        if (!$ConsultaFor1) {
            echo mysqli_error($mysqli);
        }
    } else {
        $sql = "INSERT INTO tb_bill(projectCode, providerCode , name, date, paym, GST, PST) VALUES('" . $proyectoId . "','" . $proovedores . "','" . $billNum . "','" . $date . "','" . $paym . "','" . $gst . "','" . $pst . "' )  ";
        $ConsultaBill2 = mysqli_query($mysqli, $sql);
        $bill = mysqli_insert_id($mysqli);



        if (!$ConsultaBill2) {
            echo mysqli_error($mysqli);
        }

        for ($i = 0; $i < $c; $i++) {
            $sql = "INSERT INTO tb_materiales(Bill,descripcion,cantidad,costo,total) VALUES('" . $bill . "'  ,'" . $concepto[$i] . "' , '" . $cantidad[$i] . "' , '" . $precio[$i] . "' , '" . $total[$i] . "') ";
            $ConsultaFor2 = mysqli_query($mysqli, $sql);
        }
        if (!$ConsultaFor2) {
            echo mysqli_error($mysqli);
        }
    }
}

