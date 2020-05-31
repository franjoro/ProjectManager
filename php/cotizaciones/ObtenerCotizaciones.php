<?php
$cliente = $_GET['cliente'];
require_once("../conexion.php");
$sql = "SELECT descripcion,cantidad,costo,total,code FROM tb_cotizaciones WHERE projectCode='" . $cliente . "' ";
$total = 0;
$query = mysqli_query($mysqli, $sql);
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Concepto</th>
            <th>Cantidad</th>
            <th>Costo unitario</th>
            <th>Costo Total</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php
        while ($row = mysqli_fetch_array($query)) {
            $total = $total + $row[3];
        ?>
            <tr>
                <td><?php echo $row[0] ?></td>
                <td><?php echo $row[1] ?></td>
                <td><?php echo $row[2] ?></td>
                <td>$<?php echo $row[3] ?></td>
                <td>
                    <button class="bnt btn-outline-secondary btn-sm"><i class="fas fa-edit"></i></button>
                    <button class="bnt btn-outline-danger btn-sm DeleteBtnCtz" onclick="deleteThisCtz(<?php echo $row[4] . ',' . $cliente ?>)"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Concepto</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>$ <?php echo $total ?></th>
            <th>Editar</th>
        </tr>
    </tfoot>
</table>
<br>



<div class="row">
    <div class="col-6">
        <a href="php/reportes/linkCotizacion.php?projectCode=<?php echo $cliente ?>"><button type="button" class="btn btn-outline-secondary btn-lg btn-block">Generar enlace</button></a>
        <a href=""><button type="button" class="btn btn-outline-success btn-lg btn-block">Enviar por Email</button></a>
    </div>
    <div class="col-6">
        <hr>
        <div class="d-flex justify-content-between">
            <div class="p-2">Subtotal: </div>
            <div class="p-2">$<?php echo number_format($total, 2) ?></div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="p-2">5% GST: </div>
            <div class="p-2">$<?php echo number_format($total * 5 / 100, 2) ?></div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="p-2">Total: </div>
            <div class="p-2">$<?php echo number_format(($total * 5 / 100) + $total, 2) ?></div>
        </div>
        <hr>
    </div>
</div>




<?php
mysqli_close($mysqli);
?>