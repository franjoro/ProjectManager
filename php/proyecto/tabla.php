<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Client</th>
            <th>Property</th>
            <th>Date Start</th>
            <th>Date End</th>
            <th>Notes</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
    require_once("../conexion.php");
    $sql = "SELECT tb_proyectos.code, tb_proyectos.name, tb_clientes.name, tb_propiedades.name, tb_proyectos.datestart, tb_proyectos.dateend, tb_proyectos.notes, tb_clientes.code  FROM tb_proyectos INNER JOIN tb_clientes ON tb_proyectos.cliente = tb_clientes.code INNER JOIN tb_propiedades ON tb_proyectos.propiedad = tb_propiedades.code";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
      $code = $row[0];
    ?>
        <tr>
            <td data-columna="name" data-tabla="tb_proyectos" data-code="<?php echo $code?>"><?php echo $row[1] ?></td>
            <td data-select="cliente" data-columna="cliente" data-tabla="tb_proyectos" data-code="<?php echo $code?>">
                <?php echo $row[2] ?></td>
            <td data-select="propiedad" data-cliente="<?php echo $row[7]?>" data-columna="propiedad"  data-tabla="tb_proyectos" data-code="<?php echo $code?>">
                <?php echo $row[3] ?></td>
            <td data-columna="datestart" data-tabla="tb_proyectos" data-code="<?php echo $code?>"><?php echo $row[4] ?>
            </td>
            <td data-columna="dateend" data-tabla="tb_proyectos" data-code="<?php echo $code?>"><?php echo $row[5] ?>
            </td>
            <td data-columna="notes" data-tabla="tb_proyectos" data-code="<?php echo $code?>"><?php echo $row[6] ?></td>
            <td data-tabla="delete" data-code="<?php echo $code?>">
                <button class="btn"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        <?php
    }
    mysqli_close($mysqli);
    ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Client</th>
            <th>Property</th>
            <th>Date Start</th>
            <th>Date End</th>
            <th>Notes</th>
            <th>Delete</th>
        </tr>
    </tfoot>
</table>