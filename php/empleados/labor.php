<p>Employee: <?php echo $_GET['name']?></p>
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
$start = $_GET['entrada'];
$end = $_GET['salida'];

    $sql = "SELECT tb_labor.dateDay, tb_labor.startime, tb_labor.endtime, ( (HOUR(STR_TO_DATE( endtime,'%H:%i') )*60) + (MINUTE(STR_TO_DATE(endtime,'%H:%i'))) ) - ( (HOUR(STR_TO_DATE( startime,'%H:%i') )*60) + (MINUTE(STR_TO_DATE(startime,'%H:%i'))) ) , tb_proyectos.name, tb_labor.code , tb_empleados.term, tb_empleados.rate , tb_labor.statusLunch , tb_labor.timeL FROM tb_labor INNER JOIN tb_proyectos ON tb_labor.codeProyecto = tb_proyectos.code INNER JOIN tb_empleados ON  tb_labor.codeEmpleado = tb_empleados.code  WHERE tb_labor.dateDay BETWEEN '".$start."' AND '".$end."'  AND tb_labor.codeEmpleado = '".$empleado.":'  ";
$query = mysqli_query($mysqli, $sql);
while ($row = mysqli_fetch_array($query)) {
    $code = $row[5];

    if ($row[6] == '1') {
        $totalHora = "Salary";
    } else {

        if($row[8] == '1'){
            $row[3] = $row[3]-$row[9];
        $h = floor($row[3]/60) ;
        $m = fmod($row[3], 60);
        $date = $h." Hours ".$m." Minutes / ".$row[9]."Minutes of Lunch";
        }else{
        $h = floor($row[3]/60) ;
        $m = fmod($row[3], 60);
        $date = $h." Hours ".$m." Minutes";
        }



        if ($row[6] != 0) {
            $pago ="Salary : $".$row[7];
        } else {
            $procentajeDeHora =  number_format(((100*$m)/60)/100, 2);
            $pago  = "$".number_format(($h * $row[7])+($procentajeDeHora *$row[7]), 2);
        }
    } 
    
    ?>
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
            <td data-tabla="NotEditable"><?php echo $date?> </td>
            <td data-tabla="NotEditable"><?php echo $pago?> </td>
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