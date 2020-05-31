<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Name</th>
      <th>Contact</th>
      <th>Email</th>
      <th>Phone Office</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once("../conexion.php");
    $sql = "SELECT code,name,contact,teloffice,email FROM tb_clientes WHERE code !='0'";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
    ?>
      <tr>
        <td><?php echo $row[1] ?></td>
        <td><?php echo $row[2] ?></td>
        <td><?php echo $row[4] ?></td>
        <td><?php echo $row[3] ?></td>
        <td>
          <button class="btn"><i class="far fa-eye"></i></button>
          <button class="btn"><i class="far fa-edit"></i></i></button>
          <button class="btn" onclick="deleteCliente(<?php echo $row[0]?>)"><i class="fas fa-trash"></i></button>
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
      <th>Contact</th>
      <th>Email</th>
      <th>Phone Office</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>