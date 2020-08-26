<?php
require_once('../conexion.php');

if ($_GET['filter'] == 'empleados') {
    $sql="SELECT tb_empleados.name,( SUM(HOUR(STR_TO_DATE( endtime,'%H:%i') )*60) + SUM(MINUTE(STR_TO_DATE(endtime,'%H:%i'))) ) - ( SUM(HOUR(STR_TO_DATE( startime,'%H:%i') )*60) + SUM(MINUTE(STR_TO_DATE(startime,'%H:%i'))) ) , tb_empleados.term, tb_empleados.rate FROM tb_labor INNER JOIN tb_empleados ON tb_empleados.code = tb_labor.codeEmpleado WHERE tb_labor.status=1 ";
    
    if ($_GET['codePro']!='All') {
        $sql2="AND codeProyecto=".$_GET['codePro'];
    } else {
        $sql2=" ";
    }
    $sql3 =" AND tb_labor.dateDay BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."' GROUP BY codeEmpleado";
    $sql .=$sql2.$sql3;
    $query = mysqli_query($mysqli, $sql);
    $columns = array();
    while ($row = mysqli_fetch_array($query)) {
        $h = floor($row[1]/60) ;
        $m = fmod($row[1],60);

        $date =null;
        $date = $h." Hours ".$m." Minutes";
        $pago ="";
        if ($row[2] != 0) {
            $pago ="Salary : $".$row[3];
        } else {
            $procentajeDeHora =  number_format(((100*$m)/60)/100, 2);
            $pago  = "$".number_format(($h * $row[3])+($procentajeDeHora *$row[3]), 2);
        }
        $columns[] =   array('Name_Empleado' => $row[0], 'TotalH'=>$date ,'Salary'=>$pago);
    }
    header('Content-Type: application/json');
    echo json_encode($columns);
} elseif ($_GET['filter'] == 'proyectos') {
    $sql = "SELECT tb_proyectos.name, (SUM(HOUR(STR_TO_DATE(endtime,'%H:%i')) - HOUR(STR_TO_DATE(startime,'%H:%i')))+FLOOR(SUM(MINUTE(STR_TO_DATE(endtime,'%H:%i')) - MINUTE(STR_TO_DATE(startime,'%H:%i')))/60)) AS horas, MOD(SUM(MINUTE(STR_TO_DATE(endtime,'%H:%i')) - MINUTE(STR_TO_DATE(startime,'%H:%i'))),60) AS minutos, tb_proyectos.status, tb_proyectos.code FROM tb_labor INNER JOIN tb_proyectos ON tb_proyectos.code = tb_labor.codeProyecto GROUP BY codeProyecto";

    $query = mysqli_query($mysqli, $sql);
    echo mysqli_error($mysqli);
    $json = array();
    while ($row = mysqli_fetch_array($query)) {
        $date = "Hours: ".$row[1]." Minutes: ".$row[2];
        if($row[3]=='0'){
            $status = "Open";
        }else{
            $status = "Closed";
        }
        $json[] = array('Name_Proyecto' => $row[0], 'TotalH'=>$date ,'Salary'=>$status,'code'=>$row[4]);
    }
    header('Content-Type: application/json');
    echo json_encode($json) ;
}
