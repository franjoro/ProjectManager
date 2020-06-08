<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Name</th>
      <th>Address</th>
      <th>Owner</th>
      <th>Manager Phone</th>
      <th>Notes</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once("../conexion.php");
    $sql = "SELECT tb_propiedades.code, tb_propiedades.name, tb_propiedades.address,  tb_clientes.name,  tb_propiedades.telmgr,  tb_propiedades.notes   FROM tb_propiedades INNER JOIN tb_clientes ON tb_propiedades.owner = tb_clientes.code WHERE tb_propiedades.code != '0'
    ";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
      $code = $row[0];
    ?>
      <tr>
        <td data-columna="name" data-tabla="tb_propiedades" data-code="<?php echo $code?>"><?php echo $row[1] ?></td>
        <td data-columna="address" data-tabla="tb_propiedades" data-code="<?php echo $code?>"><?php echo $row[2] ?></td>
        <td data-tabla="NotEditable"><?php echo $row[3] ?></td>
        <td data-columna="telmgr" data-tabla="tb_propiedades" data-code="<?php echo $code?>"><?php echo $row[4] ?></td>
        <td data-columna="notes" data-tabla="tb_propiedades" data-code="<?php echo $code?>"><?php echo $row[5] ?></td>
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
      <th>Address</th>
      <th>Owner</th>
      <th>Manager Phone</th>
      <th>Notes</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>