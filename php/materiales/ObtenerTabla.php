<?php
$cliente = $_GET['cliente'];
require_once("../conexion.php");
$sql = "SELECT 
tb_bill.name,
tb_bill.date,
tb_providers.name,
SUM(tb_materiales.total)
 FROM tb_bill INNER JOIN tb_providers ON tb_bill.providerCode = tb_providers.code INNER JOIN tb_materiales ON tb_bill.code = tb_materiales.Bill WHERE tb_bill.projectCode='" . $cliente . "'  GROUP BY tb_bill.name";
$total = 0;
$query = mysqli_query($mysqli, $sql);
if(!$query){
    echo mysqli_error($mysqli);
}

?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Bill number</th>
            <th>Proovedor</th>
            <th>Costo de materiales / Sin impuestos</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_array($query)) {
            $total = $total + $row[3];
        ?>
            <tr>
                <td><?php echo $row[1] ?></td>
                <td><?php echo $row[0] ?></td>
                <td><?php echo $row[2] ?></td>
                <td>$<?php echo number_format($row[3], 2)  ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Fecha</th>
            <th>Bill number</th>
            <th>Proovedor</th>
            <th>Costo de materiales / Sin impuestos</th>
        </tr>
    </tfoot>
</table>
<br>



<div class="row">
    <div class="col-6">
        <a href="php/reportes/linkCotizacion.php?projectCode=<?php echo $cliente ?>"><button type="button" class="btn btn-outline-secondary btn-lg btn-block">Ver a detalle</button></a>
    </div>
    <div class="col-6">
        <hr>
        <div class="d-flex justify-content-between">
            <div class="p-2">Total sin impuestos: </div>
            <div class="p-2">$<?php echo number_format($total, 2) ?></div>
        </div>
        <hr>
    </div>
</div>




<?php
mysqli_close($mysqli);
?>