<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Name</th>
      <th>SIN</th>
      <th>Tel.</th>
      <th>Pin</th>
      <th>Ver horas laboradas</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once("../conexion.php");
    $sql = "SELECT tb_empleados.code, tb_empleados.name, tb_empleados.sin, tb_empleados.tel , tb_users.user FROM tb_empleados INNER JOIN tb_users ON tb_empleados.userpinid = tb_users.code";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
    ?>
      <tr>
        <td><?php echo $row[1] ?></td>
        <td><?php echo $row[2] ?></td>
        <td><?php echo $row[3] ?></td>
        <td><?php echo $row[4] ?></td>
        <td>
          <a href="#labortable"><button class="btn" onclick="showlabor(<?php echo $row[0]?>)"><i class="far fa-eye"></i></button></a>
          <a href="#labortable"><button class="btn" onclick="AddHoras(<?php echo $row[0]?>)"><i class="fas fa-plus"></i></button></a>
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
      <th>SIN</th>
      <th>Tel.</th>
      <th>Pin</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>