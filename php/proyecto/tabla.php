<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Name</th>
      <th>Client</th>
      <th>Property</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once("../conexion.php");
    $sql = "SELECT tb_proyectos.code, tb_proyectos.name, tb_clientes.name, tb_propiedades.name FROM tb_proyectos INNER JOIN tb_clientes ON tb_proyectos.cliente = tb_clientes.code INNER JOIN tb_propiedades ON tb_proyectos.propiedad = tb_propiedades.code";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
    ?>
      <tr>
        <td><?php echo $row[1] ?></td>
        <td><?php echo $row[2] ?></td>
        <td><?php echo $row[3] ?></td>
        <td>
          <button class="btn"><i class="far fa-eye"></i></button>
          <button class="btn"><i class="far fa-edit"></i></i></button>
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
      <th>Action</th>
    </tr>
  </tfoot>
</table>