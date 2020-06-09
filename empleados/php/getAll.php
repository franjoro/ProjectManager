<?php 
session_start();
?>
<table id="myTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Total Hours</th>
            <th>Project</th>
        </tr>
    </thead>

    <tbody>
<?php
require_once("../../php/conexion.php");
$empleado = $_SESSION['user'];
$sql = "SELECT tb_labor.dateDay, tb_labor.startime, tb_labor.endtime, tb_labor.totalhoras, tb_proyectos.name FROM tb_labor INNER JOIN tb_proyectos ON tb_labor.codeProyecto = tb_proyectos.code WHERE tb_labor.codeEmpleado = '".$empleado.":'  ";
$query = mysqli_query($mysqli, $sql);
while ($row = mysqli_fetch_array($query)) {
    ?>
    <tr>
        <td><?php echo $row[0]?> </td>
        <td><?php echo $row[1]?> </td>
        <td><?php echo $row[2]?> </td>
        <td><?php echo $row[3]?> </td>
        <td><?php echo $row[4]?> </td>

    </tr>
<?php
}
echo mysqli_error($mysqli);
mysqli_close($mysqli);

?>


    </tbody>

</table>
