<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Name</th>
      <th>Address</th>
      <th>Owner</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once("../conexion.php");
    $sql = "SELECT tb_propiedades.code, tb_propiedades.name, tb_propiedades.address,  tb_clientes.name FROM tb_propiedades INNER JOIN tb_clientes ON tb_propiedades.owner = tb_clientes.code WHERE tb_propiedades.code != '0'
    ";
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
          <button class="btn" onclick="deletePropiedades(<?php echo $row[0] ?>)" ><i class="fas fa-trash"></i></button>
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
      <th>Address</th>
      <th>Owner</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>