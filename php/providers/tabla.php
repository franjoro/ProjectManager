<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Name</th>
      <th>Acct No.</th>
      <th>Store</th>
      <th>Mgr</th>
      <th>Tel.</th>
      <th>Notes</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once("../conexion.php");
    $sql = "SELECT * FROM tb_providers WHERE code != '0'";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
       $code = $row[0];
    ?>
      <tr>
        <td data-columna="name" data-tabla="tb_providers" data-code="<?php echo $code?>"><?php echo $row[1] ?></td>
        <td data-columna="acct" data-tabla="tb_providers" data-code="<?php echo $code?>"><?php echo $row[2] ?></td>
        <td data-columna="store" data-tabla="tb_providers" data-code="<?php echo $code?>"><?php echo $row[3] ?></td>
        <td data-columna="mgr" data-tabla="tb_providers" data-code="<?php echo $code?>"><?php echo $row[4] ?></td>
        <td data-columna="tel" data-tabla="tb_providers" data-code="<?php echo $code?>"><?php echo $row[5] ?></td>
        <td data-columna="notes" data-tabla="tb_providers" data-code="<?php echo $code?>"><?php echo $row[6] ?></td>
        <td data-tabla="delete" data-code="<?php echo $code?>">
          <button class="btn"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
    <?php
    }
    mysqli_close($mysqli);
    ?>
  </tbody>
</table>