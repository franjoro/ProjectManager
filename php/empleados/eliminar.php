<?php
require_once("../conexion.php");
$id = $_GET['id'];
$sql = "SELECT userpinid FROM tb_empleados WHERE code='".$id."' ";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query);

$sql = "DELETE FROM tb_users WHERE code='".$row[0]."' ";
if ($query =mysqli_query($mysqli, $sql)) {
    echo mysqli_insert_id($mysqli);
    ;
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
}
mysqli_close($mysqli);
