<?php
$cliente = $_GET['cliente'];
require_once("../conexion.php");
$sql = "SELECT 
tb_bill.name,
tb_bill.date,
tb_providers.name,
SUM(tb_materiales.total),
tb_bill.code
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
            <th>Date</th>
            <th>Bill number</th>
            <th>Provider</th>
            <th>Material cost / Without taxes</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_array($query)) {
            $total = $total + $row[3];
            $code = $row[4];
        ?>
        <tr>
            <td data-tabla="NotEditable"><?php echo $row[1] ?></td>
            <td data-columna="name" data-tabla="tb_bill" data-code="<?php echo $code?>"><?php echo $row[0] ?></td>
            <td data-tabla="NotEditable"><?php echo $row[2] ?></td>
            <td data-tabla="NotEditable">$<?php echo number_format($row[3], 2)  ?></td>
            <td  data-tabla="delete" data-code="<?php echo $code?>">
                <button class="bnt btn-outline-danger btn-sm "
                    onclick="deleteThisCosto(<?php echo $row[4] . ',' . $cliente ?>)"><i
                        class="far fa-trash-alt"></i></button>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<br>



<div class="row">
    <div class="col-6">
        <a href="php/reportes/consolidadoProyecto.php?projectCode=<?php echo $cliente ?>"><button type="button"
                class="btn btn-outline-secondary btn-lg btn-block">Ver a detalle</button></a>
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