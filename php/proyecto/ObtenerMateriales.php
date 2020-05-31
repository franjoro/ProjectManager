<?php
$cliente = $_GET['cliente'];
require_once("../conexion.php");
$sql = "SELECT 
tb_providers.name, 
tb_materiales.Bill, 
tb_materiales.descripcion, 
tb_materiales.total 
FROM tb_materiales INNER JOIN tb_proyectos ON tb_materiales.projectCode = tb_proyectos.code INNER JOIN tb_providers ON tb_materiales.providerCode = tb_providers.code 

 WHERE tb_proyectos.code='" . $cliente . "' ";
$total = 0;
$query = mysqli_query($mysqli, $sql);
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Proovedores</th>
            <th>Bill Number</th>
            <th>Concepto</th>
            <th>Costo Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Proovedores</th>
            <th>Bill Number</th>
            <th>Concepto</th>
            <th>Costo Total</th>
            <th>Action</th>
        </tr>
    </tfoot>
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
                <td>Botones...</td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<br>

<h5 class="text-right">Total de dinero gastado: $<?php echo $total ?></h5>
<?php
mysqli_close($mysqli);
?>