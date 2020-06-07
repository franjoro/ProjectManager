<?php
    require_once("../conexion.php");
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_clientes WHERE code='".$id."' ";
    $query = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_array($query);
    mysqli_close($mysqli);
?>

<div class="row">
    <div class="col-4"><p> <b>  Name:</b> <?php echo $row[1] ?></p></div>
    <div class="col-4"><p> <b> Address: </b><?php echo $row[2] ?></p></div>
    <div class="col-4"><p> <b> Contact:</b></b> <?php echo $row[3] ?></p></div>
</div>
<div class="row">
    <div class="col-4"><p> <b> Phone Office:</b> <?php echo $row[4] ?></p></div>
    <div class="col-4"><p> <b> Phone Cel:</b> <?php echo $row[5] ?></p></div>
    <div class="col-4"><p> <b> Phone Other: </b><?php echo $row[6] ?></p></div>
</div>
<div class="row">
    <div class="col-6"> <b> Email: </b><p><?php echo $row[7] ?></p></div>
    <div class="col-6"> <b> Notes:</b> <p><?php echo $row[8] ?></p></div>
</div>
