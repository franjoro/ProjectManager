<?php
require_once('../conexion.php'); if ($_GET['filter']=='empleados') {
    $sql="SELECT tb_bill.name, tb_providers.name, SUM(tb_materiales.total), tb_proyectos.name, tb_bill.GST, tb_bill.PST  FROM `tb_materiales` INNER JOIN tb_bill ON tb_bill.code=tb_materiales.Bill INNER JOIN tb_proyectos ON tb_proyectos.code=tb_bill.projectCode INNER JOIN tb_providers ON tb_bill.providerCode=tb_providers.code ";
    if ($_GET['codePro']!='All') {
        $sql2="WHERE tb_bill.projectCode=".$_GET['codePro']." AND " ;
    } else {
        $sql2=" WHERE ";
    }
    $sql3=" tb_bill.date BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."' GROUP BY tb_bill.code ";
    $sql .=$sql2.$sql3;
    $query=mysqli_query($mysqli, $sql);
    $columns=array();
    
    
    
    while ($row=mysqli_fetch_row($query)) {
    $imp = 0;
        
        if($row[4] == 1){
            $imp = $imp+5;
        }
        if ($row[5] == 1) {
            $imp = $imp +7;
        }
        $totalConIm = (($row[2]*$imp)/100)+$row[2];
        $columns[]=array('Name_Empleado'=>$row[0], 'TotalH'=>$row[1] ,'Salary'=>"$".number_format($totalConIm, 2),'Salary1'=>$row[3]);
    }
    header('Content-Type:application/json');
    echo json_encode($columns);
} elseif ($_GET['filter']=='proyectos') {
    $sql="SELECT tb_materiales.descripcion, tb_providers.name, tb_materiales.total, tb_bill.GST, tb_bill.PST , tb_bill.date, tb_proyectos.name, tb_bill.name FROM `tb_materiales` INNER JOIN tb_bill ON tb_bill.code=tb_materiales.Bill INNER JOIN tb_providers ON tb_bill.providerCode=tb_providers.code  INNER JOIN tb_proyectos ON tb_bill.projectCode = tb_proyectos.code  WHERE tb_bill.date BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."' GROUP BY tb_materiales.descripcion ";
    $query=mysqli_query($mysqli, $sql);
    echo mysqli_error($mysqli);
    $json=array();
    while ($row=mysqli_fetch_array($query)) {
        $imp = 0;
         if ($row[3] == 1) {
            $imp = $imp+5;
        }
        if ($row[4] == 1) {
            $imp = $imp +7;
        }
        $totalConIm = (($row[2]*$imp)/100)+$row[2];
        $json[]=array('descri'=>$row[0],'name'=>$row[1],'bill'=>$row[7],'total'=>"$".number_format($totalConIm, 2),'date'=>$row[5],'project'=>$row[6]);
    }
    header('Content-Type:application/json');
    echo json_encode($json) ;
}
