<?php
require_once("../conexion.php");
$pin = $_GET['pin'];
$sql = mysqli_query($mysqli, "SELECT COUNT(user) FROM tb_users WHERE user = '" . $pin . "' ");
$row = mysqli_fetch_array($sql);

if ($row[0] <= 0) {
    $pass = md5($pin);
    $sql = "INSERT INTO tb_users(user,pass,role) VALUES ('" . $_POST['pin'] . "','" . $pass . "','1') ";
    $query = mysqli_query($mysqli, $sql);
    $iduserping = mysqli_insert_id($mysqli);
    if (!$query) {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
    } else {
    $sql = "INSERT INTO tb_empleados(sin, userpinid ,name,address,tel,spouse,telspouse,term,rate,emrgcontact,telemergcontact) VALUES('" . $_POST['sin'] . "','" . $iduserping . "','" . $_POST['name'] . "','" . $_POST['address'] . "' ,'" . $_POST['tel'] . "' ,'" . $_POST['spouse'] . "','" . $_POST['telspouse'] . "' ,'" . $_POST['term'] . "','" . $_POST['rate'] . "' ,'" . $_POST['emrg'] . "','" . $_POST['telemrg'] . "') ";
    $query = mysqli_query($mysqli, $sql);
    if (!$query) {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
    }}
} else {
    echo "pinUsed";
}

mysqli_close($mysqli);
