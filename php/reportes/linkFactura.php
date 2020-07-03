<?php
require_once('../conexion.php');
$id = $_GET['projectCode'];
$sqlDatos = "SELECT workZone, total, code FROM tb_workzone WHERE codeProyecto='".$id."'";
$querydatos = mysqli_query($mysqli, $sqlDatos);

$sqlClient = "SELECT
tb_proyectos.name,
tb_proyectos.notes,
tb_clientes.name,
tb_clientes.address,
tb_clientes.teloffice,
tb_clientes.email, tb_proyectos.invoiceCode FROM tb_proyectos INNER JOIN tb_clientes ON tb_proyectos.cliente = tb_clientes.code WHERE tb_proyectos.code = '" . $id . "'";
$queryClient = mysqli_query($mysqli, $sqlClient);


if (!$querydatos) {
    echo mysqli_error($mysqli);
} else {
}
$datos = mysqli_fetch_array($queryClient);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="container invoice ">
        <div class="invoice-header ">
            <div class="row">
                <div class="col-xs-7">
                    <div class="media">
                        <div class="media-left">
                            <img class="media-object logo" src="logo.png" />
                            <h4 class="text-muted">7787 Oak Street, Vancouver, BC V6P 4A4
                                <br> Tel (604) 592-0237</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5">
                    <h1>Invoice</h1>
                    <h4 class="text-muted">NO: <?php echo $datos[6] ?> | <?php echo date("d/m/Y") ?> </h4>
                </div>
            </div>
        </div>
        <div class="invoice-body shadow p-3 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-xs-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Project Generals</h3>
                        </div>
                        <div class="panel-body">
                            <h6 class="text-muted"> <?php echo $datos[1] ?> </h6>
                        </div>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Customer Details</h3>
                        </div>
                        <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Name</dt>
                                <dd><?php echo $datos[2]; ?></dd>
                                <dt>Address</dt>
                                <dd><?php echo $datos[3]; ?></dd>
                                <dt>Phone</dt>
                                <dd><?php echo $datos[4]; ?></dd>
                                <dt>Email</dt>
                                <dd><?php echo $datos[5]; ?></dd>
                                <dt>&nbsp;</dt>
                                <dd>&nbsp;</dd>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Services / Products</h3>
                </div>
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center"><b>DESCRIPTION</b></th>
                            <th class="text-center colfix">Sum Cost</th>
                            <th class="text-center colfix">Tax</th>
                            <th class="text-center colfix">Total</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $subtotal = 0;
                        $subTax = 0;
                        $totalgeneral = 0;

                        while ($row = mysqli_fetch_array($querydatos)) {
                            $code = $row[2];
                        
                            $sql = "SELECT tb_workc.category, tb_workc.total, tb_cotizaciones.descripcion FROM `tb_workc` INNER JOIN tb_cotizaciones ON tb_workc.code = tb_cotizaciones.codeWorkC WHERE tb_workc.codeZone ='".$code."' ";
                            $query = mysqli_query($mysqli, $sql);

                            //variables
                            $categoria="";
                            $precioConImp = ($row[1] *5)/100;
                            $sumaPreciomasImpu = $row[1] + $precioConImp;

                            //totales
                            $subtotal = $subtotal +$row[1];
                            $subTax = $subTax + $precioConImp;
                            $totalgeneral = $totalgeneral +$sumaPreciomasImpu; ?>
                        <tr>
                            <td>
                                <b><ins><?php echo strtoupper($row[0]) ?>:</ins></b><br>
                        <?php while ($rows = mysqli_fetch_array($query)) { ?>
                                <?php
                                    if ($rows[0] !== $categoria) {
                                        echo "<p><b>".$rows[0]."</b> $".$rows[1]."</p> <p>-".$rows[2]."</p>";
                                    } else {
                                        echo "<p>-".$rows[2]."</p>";
                                    }
                                    ?>
                                
                        <?php
                    $categoria = $rows[0];
                    } ?>
                            </td>
                            <td class="text-right">
                                <span class="mono">$ <?php echo number_format($row[1], 2)  ?>  </span>
                                <br>
                                <small class="text-muted"> Units</small>
                            </td>
                            <td class="text-right">
                                <span class="mono">+ $<?php echo number_format($precioConImp, 2)?></span>
                                <br>
                                <small class="text-muted">GST 5% </small>
                            </td>
                            <td class="text-right">
                                <strong class="mono">$ <?php echo number_format($sumaPreciomasImpu, 2)  ?> </strong>
                                <br>
                            </td>
                        </tr>
                        <?php
                        $categoria ="";
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
                            <th class="text-center rowtotal mono">$ <?php echo number_format($subtotal, 2)?> </th>
                            <th class="text-center rowtotal mono">$ <?php echo number_format($subTax, 2)?></th>
                            <th class="text-center rowtotal mono">$ <?php echo number_format($totalgeneral, 2)?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="row">
                <div class="col-xs-7">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <i>Comments / Notes</i>
                            <hr style="margin:3px 0 40px" /><?php echo $datos[1]; ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Payment Method</h3>
                        </div>
                        <div class="panel-body">
                            <p>For your convenience, you may deposite the final ammount at one of our banks</p>
                            <ul class="list-unstyled">
                                <li>Example Bank - <span class="mono">*</span></li>
                                <li>Example Bank - <span class="mono">*</span></li>
                                <li>Example Bank - <span class="mono">*</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->


        </div>
        <div class="invoice-footer">
            Thank you for choosing our services.
            <br /> We hope to see you again soon
            <br />
            <strong>~FTP~</strong>
        </div>
    </div>
    <!-- partial -->

</body>

</html>
<?php
mysqli_close($mysqli);

?>