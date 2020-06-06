<?php 
require_once('../conexion.php');
$proyecto = $_GET['projectCode'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      href="../../vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
      integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Hello, world!</title>
  </head>
  <body>
    <!-- As a link -->
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="../../materiales.php"
        ><i class="fas fa-arrow-left"></i
      ></a>
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
                      <th><b> Item / Details </b></th>
                      <th class="text-center colfix">Unit Cost</th>
                      <th class="text-center colfix">Sum Cost</th>
                      <th class="text-center colfix">Tax</th>
                      <th class="text-center colfix">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $tbruto = 0;
                        $timpuesto = 0;
                        $ttotal = 0;
                        while ($row = mysqli_fetch_array($querydatos)) {
                            $dinerosinComa = str_replace(",","",$row[2]);
                            $bruto = $dinerosinComa * $row[1];
                            $impuesto = $bruto * 5 / 100;
                            $total = ($bruto * 5 / 100) + $bruto;

                            $tbruto = $tbruto + $bruto;
                            $timpuesto = $timpuesto + $impuesto;
                            $ttotal = $ttotal + $total;
                        ?>
                    <tr>
                      <td>
                        <?php echo $row[0] ?>
                      </td>
                      <td class="text-right">
                        <span class="mono"
                          >$
                          <?php echo number_format($dinerosinComa, 2) ?></span
                        >
                        <br />
                        <small class="text-muted">Before Tax</small>
                      </td>
                      <td class="text-right">
                        <span class="mono"
                          >$
                          <?php echo number_format($bruto, 2)  ?></span
                        >
                        <br />
                        <small class="text-muted"
                          ><?php echo $row[1] ?>
                          Units</small
                        >
                      </td>
                      <td class="text-right">
                        <span class="mono"
                          >+ $<?php echo number_format($impuesto, 2) ?></span
                        >
                        <br />
                        <small class="text-muted">GST 5% </small>
                      </td>
                      <td class="text-right">
                        <strong class="mono"
                          >$<?php echo number_format($total, 2) ?></strong
                        >
                        <br />
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
                      <td class="text-center col-xs-1">Sub Total</td>
                      <td class="text-center col-xs-1">Tax</td>
                      <td class="text-center col-xs-1">Total</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th class="text-center rowtotal mono">
                        $
                        <?php echo number_format($tbruto, 2) ?>
                      </th>
                      <th class="text-center rowtotal mono">
                        $
                        <?php echo number_format($timpuesto, 2) ?>
                      </th>
                      <th class="text-center rowtotal mono">
                        $
                        <?php echo number_format($ttotal, 2) ?>
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
                      <th class="text-center colfix">Start - End Hour</th>
                      <th class="text-center colfix">Hours Worked</th>
                      <th class="text-center colfix">Payment</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                        $sql = "SELECT tb_empleados.name, tb_empleados.term, tb_empleados.rate, tb_labor.dateDay, tb_labor.startime, tb_labor.endtime, tb_labor.totalhoras FROM `tb_labor` INNER JOIN tb_empleados ON tb_labor.codeEmpleado = tb_empleados.code WHERE tb_labor.codeProyecto = '".$proyecto."' ORDER BY tb_empleados.name ";

                        $query= mysqli_query($mysqli, $sql);
                        while ($row = mysqli_fetch_array($query)) {
                          $pay = "";
                          if($row[1] == 1){
                            $pay = "Monthly salary";
                          }else{
                            $horastotales = str_replace(":", ".",$row[6]);

                            $pay = number_format($horastotales * $row[2], 2 );
                          }
                        ?>
                    <tr>
                      <td>
                        <?php echo $row[0] ?>
                      </td>
                      <td class="text-right">
                        <span class="mono"
                          >
                        <?php echo $row[3] ?> </span
                        >
                        <br />
                        <!-- <small class="text-muted">Before Tax</small> -->
                      </td>
                      <td class="text-right">
                        <span class="mono"
                          >Start: 
                          <?php echo  $row[4] ?></span
                        >
                        <br />
                        <small class="text-muted"
                          >End : <?php echo $row[5] ?>
                          </small
                        >
                      </td>
                      <td class="text-right">
                        <span class="mono"
                          ><?php echo $row[6] ?></span
                        >
                        <br />
                      </td>
                      <td class="text-right">
                        <strong class="mono"
                          >$ <?php echo $pay ?></strong>
                        <br />
                        <small class="text-muted">Per Hour: $<?php echo number_format( $row[2] ,2); ?> </small>
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
                      <td class="text-center col-xs-1">Total Hours Worked</td>
                      <td class="text-center col-xs-1">Tax</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th class="text-center rowtotal mono">
                        $
                        <?php echo number_format($tbruto, 2) ?>
                      </th>
                      <th class="text-center rowtotal mono">
                        $
                        <?php echo number_format($timpuesto, 2) ?>
                      </th>
                      <th class="text-center rowtotal mono">
                        $
                        <?php echo number_format($ttotal, 2) ?>
                      </th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> -->
  </body>
</html>
