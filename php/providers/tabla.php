<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Name</th>
      <th>Store</th>
      <th>Tel.</th>
      <th>Pay Method</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once("../conexion.php");
    $sql = "SELECT code,name,store,tel,paymethod FROM tb_providers WHERE code != '0'";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
    ?>
      <tr>
        <td><?php echo $row[1] ?></td>
        <td><?php echo $row[2] ?></td>
        <td><?php echo $row[3] ?></td>
        <td><?php echo $row[4] ?></td>
        <td>
          <button class="btn"><i class="far fa-eye"></i></button>
          <button class="btn"><i class="far fa-edit"></i></i></button>
          <button class="btn" onclick="deleteProviders(<?php echo $row[0] ?>)" ><i class="fas fa-trash"></i></button>
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
      <th>Store</th>
      <th>Tel.</th>
      <th>Pay Method</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>