<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>SIN</th>
            <th>Tel.</th>
            <th>Pin</th>
            <th>Spouse</th>
            <th>Tel. Spouse</th>
            <th>Term</th>
            <th>Rate</th>
            <th>Emergency contact</th>
            <th>Tel. Emergency</th>
            <th>Delete</th>
            <th>Restart Password</th>
        </tr>
    </thead>
    <tbody>
        <?php
    require_once("../conexion.php");
    $sql = "SELECT tb_empleados.code, tb_empleados.name, tb_empleados.sin, tb_empleados.tel , tb_users.user, tb_empleados.spouse , tb_empleados.telspouse , tb_empleados.term , tb_empleados.rate , tb_empleados.emrgcontact , tb_empleados.telemergcontact   FROM tb_empleados INNER JOIN tb_users ON tb_empleados.userpinid = tb_users.code";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
      $code = $row[0];
      if($row[7] == 0){
          $term = "Hour";
    }else{
          $term = "Salary";
      }
    ?>
        <tr>
            <td data-columna="name" data-tabla="tb_empleados" data-code="<?php echo $code?>"><?php echo $row[1] ?></td>
            <td data-columna="sin" data-tabla="tb_empleados" data-code="<?php echo $code?>"><?php echo $row[2] ?></td>
            <td data-columna="tel" data-tabla="tb_empleados" data-code="<?php echo $code?>"><?php echo $row[3] ?></td>
            <td data-tabla="NotEditable"><?php echo $row[4] ?></td>
            <td data-columna="spouse" data-tabla="tb_empleados" data-code="<?php echo $code?>"><?php echo $row[5] ?>
            </td>
            <td data-columna="telspouse" data-tabla="tb_empleados" data-code="<?php echo $code?>"><?php echo $row[6] ?>
            </td>
            <td data-tabla="NotEditable"><?php echo $term?></td>
            <td data-columna="rate" data-tabla="tb_empleados" data-code="<?php echo $code?>"><?php echo $row[8] ?></td>
            <td data-columna="emrgcontact" data-tabla="tb_empleados" data-code="<?php echo $code?>">
                <?php echo $row[9] ?></td>
            <td data-columna="telemergcontact" data-tabla="tb_empleados" data-code="<?php echo $code?>">
                <?php echo $row[10] ?></td>
            <td data-tabla="delete" data-code="<?php echo $code?>">
                <button class="btn"><i class="fas fa-trash"></i></button>
            </td>
            <td data-tabla="restart" data-code="<?php echo $code?>">
                <button class="btn"><i class="fas fa-key"></i></button>
            </td>
        </tr>
        <?php
    }
    mysqli_close($mysqli);
    ?>
    </tbody>
</table>