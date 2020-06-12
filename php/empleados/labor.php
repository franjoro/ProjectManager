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
            <th>Payment</th>
            <th>Project</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php
require_once("../../php/conexion.php");
$empleado = $_GET['id'];
if ($empleado == 'all') {
    $sql = "SELECT tb_labor.dateDay, tb_labor.startime, tb_labor.endtime, tb_labor.totalhoras, tb_proyectos.name FROM tb_labor INNER JOIN tb_proyectos ON tb_labor.codeProyecto = tb_proyectos.code ";
} else {
    $sql = "SELECT tb_labor.dateDay, tb_labor.startime, tb_labor.endtime, tb_labor.totalhoras, tb_proyectos.name, tb_labor.code , tb_empleados.term, tb_empleados.rate FROM tb_labor INNER JOIN tb_proyectos ON tb_labor.codeProyecto = tb_proyectos.code INNER JOIN tb_empleados ON  tb_labor.codeEmpleado = tb_empleados.code WHERE tb_labor.codeEmpleado = '".$empleado.":'  ";
}




$query = mysqli_query($mysqli, $sql);
while ($row = mysqli_fetch_array($query)) {
    $code = $row[5];

    if ($row[6] == '1') {
        $totalHora = "Salary";
    } else {
        $horasTotales = $row[3];
        $horasTPunto = $array = explode(":", $horasTotales);
        $procentajeDeHora =  number_format(((100*$array[1])/60)/100, 2);
        $totalHora  = "$".number_format(($array[0] * $row[7])+($procentajeDeHora *$row[7]), 2);
    } ?>
        <tr>
            <td data-start="<?php echo $row[1]?>" data-end="<?php echo $row[2]?>" data-empleado="<?php echo $empleado?>"
                data-code="<?php echo $code?>">
                <?php echo $row[0]?> </td>
            <td data-start="<?php echo $row[1]?>" data-end="<?php echo $row[2]?>" data-empleado="<?php echo $empleado?>"
                data-code="<?php echo $code?>">
                <?php echo $row[1]?> </td>
            <td data-start="<?php echo $row[1]?>" data-end="<?php echo $row[2]?>" data-empleado="<?php echo $empleado?>"
                data-code="<?php echo $code?>">
                <?php echo $row[2]?> </td>
            <td data-tabla="NotEditable"><?php echo $row[3]?> </td>
            <td data-tabla="NotEditable"><?php echo $totalHora?> </td>
            <td data-tabla="NotEditable"><?php echo $row[4]?> </td>
            <td data-tabla="delete" data-code="<?php echo $code?>" data-empleado="<?php echo $empleado?>">
                <button class="btn"><i class="fas fa-trash"></i></button>
            </td>

        </tr>
        <?php
}
echo mysqli_error($mysqli);
mysqli_close($mysqli);

?>


    </tbody>

</table>