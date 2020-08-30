<?php
require_once('../conexion.php');
$proyecto = $_GET['projectCode'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <title>Proyect Details</title>
</head>

<body>
    <!-- As a link -->
    <nav class="navbar navbar-light bg-light">
        <?php if ($_GET['report'] == 'true') {
    $back = "../../reportes.php";
} else {
    $back = "../../materiales.php";
} ?>
        <a class="navbar-brand" href="<?php echo $back ?>"><i class="fas fa-arrow-left"></i></a>
    </nav>

    <div class="container-fluid p-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Services / Products</h3>
                            </div>
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th><b>Bill number</b></th>
                                        <th class="text-center"> Item / Details </th>
                                        <th class="text-center colfix">Unit cost</th>
                                        <th class="text-center colfix">Sum Cost</th>
                                        <th class="text-center colfix">Tax</th>
                                        <th class="text-center colfix">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT tb_materiales.descripcion , tb_materiales.cantidad, tb_materiales.costo, tb_materiales.total, tb_providers.name , tb_bill.name, tb_bill.date, tb_bill.paym , tb_bill.GST , tb_bill.PST,tb_bill.code FROM tb_bill INNER JOIN tb_materiales ON tb_bill.code = tb_materiales.Bill INNER JOIN tb_providers ON tb_bill.providerCode = tb_providers.code WHERE tb_bill.projectCode='" . $proyecto . "' ";
                                    $query = mysqli_query($mysqli, $sql);
                                    $subtotal = 0;
                                    $totaltaxes = 0;
                                    $totalNeto = 0;


                                    $totalBill = 0;
                                    $bandera = false;
                                    $ancla ;
                                    while ($row = mysqli_fetch_array($query)) {
                                        if($bandera == false){
                                            $ancla = $row[10];
                                            $bandera = true;
                                        }
                                        if ($ancla != $row[10]) {
                                            echo '
                                      <tr class="bg-light ">
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"><strong
                                                class="mono">$'.number_format($totalBill, 2) .'</strong>
                                    </td>
                                    </tr>
                                    ';
                                    $totalBill = 0;
                                    }

                                    $tr = str_replace(" ", ",", $row[2]);
                                    //impuestos
                                    $impuesto = 0;
                                    $gst = "";
                                    $pst = "";
                                    if ($row[8] == '1') {
                                    $impuesto = $impuesto + 5;
                                    $gst = "GST 5%";
                                    }
                                    if ($row[9] == '1') {
                                    $impuesto = $impuesto + 7;
                                    $pst = "PST 7%";
                                    }
                                    $ConImpuestos = $row[3] * $impuesto / 100;
                                    $total = $row[3] + $ConImpuestos;
                                    $totalBill = $totalBill + $total;

                                    //Totales
                                    $subtotal = $subtotal + $row[3];
                                    $totaltaxes = $totaltaxes + $ConImpuestos;
                                    $totalNeto = $totalNeto + $total; ?>

                                    <tr>
                                        <td>
                                            <?php echo $row[5] ?>
                                            <br />
                                            <small class="text-muted"><b>Provider: </b> <?php echo $row[4] ?></small>
                                            <br>
                                            <small class="text-muted"><b>Date: </b> <?php echo $row[6] ?></small>

                                        </td>
                                        <td class="text-left">
                                            <span class="mono"> <?php echo $row[0] ?></span>
                                        </td>
                                        <td class="text-right">
                                            <span class="mono">$
                                                <?php echo $tr ?></span>
                                            <br />
                                            <small class="text-muted"><?php echo $row[1] ?>
                                                Units</small>
                                        </td>
                                        <td class="text-right">
                                            <span class="mono"> $<?php echo number_format($row[3], 2) ?></span>
                                        </td>
                                        <td class="text-right">
                                            <strong class="mono">$<?php echo number_format($ConImpuestos, 2) ?></strong>
                                            <br />
                                            <small class="text-muted"><?php echo $pst ?> </small>
                                            <br />
                                            <small class="text-muted"><?php echo $gst ?> </small>
                                        </td>
                                        <td class="text-right">
                                            <strong class="mono">$<?php echo number_format(($total), 2) ?></strong>
                                            <br />
                                        </td>
                                    </tr>

                                    <?php
                                        $ancla = $row[10]; ?>
                                    <?php
                                    }
                                    ?>
                                    <tr class="bg-light ">
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right">
                                        <strong class="mono">$<?php echo number_format($totalBill, 2) ?></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="panel panel-default">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <td class="text-center col-xs-1">Sub Total</td>
                                        <td class="text-center col-xs-1">Tax</td>
                                        <td class="text-center col-xs-1">Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-center rowtotal mono">
                                            $
                                            <?php echo number_format($subtotal, 2) ?>
                                        </th>
                                        <th class="text-center rowtotal mono">
                                            $
                                            <?php echo number_format($totaltaxes, 2) ?>
                                        </th>
                                        <th class="text-center rowtotal mono">
                                            $
                                            <?php echo number_format($totalNeto, 2) ?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default table-responsive">
                            <div class="panel-heading">
                                <h3 class="panel-title">Labor services</h3>
                            </div>
                            <table class="table table-bordered table-condensed ">
                                <thead>
                                    <tr>
                                        <th class="text-center colfix">Employee</th>
                                        <th class="text-center colfix">Work Day</th>
                                        <th class="text-center colfix">Hours Worked</th>
                                        <th class="text-center colfix">Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $sql = "SELECT tb_empleados.name, tb_empleados.term, tb_empleados.rate, tb_labor.dateDay, ( (HOUR(STR_TO_DATE(tb_labor.endtime,'%H:%i'))*60+MINUTE(STR_TO_DATE(endtime,'%H:%i'))) - (HOUR(STR_TO_DATE(tb_labor.startime,'%H:%i'))*60+MINUTE(STR_TO_DATE(tb_labor.startime,'%H:%i')))  )   FROM `tb_labor` INNER JOIN tb_empleados ON tb_labor.codeEmpleado = tb_empleados.code WHERE tb_labor.codeProyecto = '" . $proyecto . "' ORDER BY tb_labor.dateDay ";

                                    $query = mysqli_query($mysqli, $sql);
                                    $pagosTotales = 0;

                                    while ($row = mysqli_fetch_array($query)) {
                                        $h = floor($row[4] / 60);
                                        $m = fmod($row[4], 60);
                                        if ($m < 10) {
                                            $workDone =$h.":0".$m;
                                        } else {
                                            $workDone =$h.":".$m;
                                        }
                                        $pay = "";
                                        if ($row[1] == 1) {
                                            $resultPay = "Monthly salary";
                                            $pay = 0;
                                        } else {
                                            $horasTotales = $row[4];
                                            $procentajeDeHora =  number_format(((100 * $m) / 60) / 100, 2);
                                            $pay  = number_format(($h * $row[2]) + ($procentajeDeHora * $row[2]), 2);
                                            $resultPay = $pay;
                                        }
                                        $pagosTotales = $pagosTotales + $pay; ?>
                                    <tr>
                                        <td>
                                            <?php echo $row[0] ?>
                                        </td>
                                        <td class="text-right">
                                            <span class="mono">
                                                <?php echo $row[3] ?> </span>
                                            <br />
                                            <!-- <small class="text-muted">Before Tax</small> -->
                                        </td>
                                        <td class="text-right">
                                            <span class="mono"><?php echo $workDone ?></span>
                                            <br />
                                        </td>
                                        <td class="text-right">
                                            <strong class="mono">$ <?php echo $resultPay ?></strong>
                                            <br />
                                            <small class="text-muted">Per Hour:
                                                $<?php echo number_format($row[2], 2); ?> </small>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="panel panel-default">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <!-- <td class="text-center col-xs-1">Total Hours Worked</td> -->
                                        <td class="text-center col-xs-1">Payment</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <th class="text-center rowtotal mono">
                                            <?php // echo $horastotales
                                            ?>
                                        </th>
                                        <th class="text-center rowtotal mono">
                                            $
                                            <?php //echo number_format($timpuesto, 2)
                                            ?>
                                        </th> -->
                                        <th class="text-center rowtotal mono">
                                            $
                                            <?php echo number_format($pagosTotales, 2) ?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <!-- <td class="text-center col-xs-1">Total Hours Worked</td> -->
                                    <td class="text-center col-xs-1">Total Cost</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center rowtotal mono">
                                        $
                                        <?php echo number_format($totalNeto + $pagosTotales, 2) ?>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> -->
</body>

</html>