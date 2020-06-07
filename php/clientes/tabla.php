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
      $code = $row[0];
    ?>
      <tr>
        <td data-columna="name" data-tabla="tb_clientes"   data-code="<?php echo $code?>"   ><?php echo $row[1] ?></td>
        <td data-columna="contact" data-tabla="tb_clientes"   data-code="<?php echo $code?>"   ><?php echo $row[2] ?></td>
        <td data-columna="email" data-tabla="tb_clientes"   data-code="<?php echo $code?>"   ><?php echo $row[4] ?></td>
        <td data-columna="teloffice" data-tabla="tb_clientes"   data-code="<?php echo $code?>"   ><?php echo $row[3] ?></td>
        <td>
          <button class="btn" onclick="seeClientes(<?php echo $row[0]?>)" ><i class="far fa-eye"></i></button>
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