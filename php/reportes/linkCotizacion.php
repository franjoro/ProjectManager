<?php
require_once('../conexion.php');
$id = $_GET['projectCode'];
$sqlDatos = "SELECT descripcion,cantidad, costo, total FROM tb_cotizaciones WHERE projectCode  = '" . $id . "'";
$querydatos = mysqli_query($mysqli, $sqlDatos);

$sqlClient = "SELECT
tb_proyectos.name,
tb_proyectos.notes,
tb_clientes.name,
tb_clientes.address,
tb_clientes.teloffice,
tb_clientes.email FROM tb_proyectos INNER JOIN tb_clientes ON tb_proyectos.cliente = tb_clientes.code WHERE tb_proyectos.code = '" . $id . "'";
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
                        </div>
                    </div>
                </div>
                <div class="col-xs-5">
                    <h1>Estimate Contracts</h1>
                    <h4 class="text-muted">NO: <?php echo $datos[0] ?> | <?php echo date("d/m/Y") ?> </h4>
                </div>
            </div>
        </div>
        <div class="invoice-body shadow p-3 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-xs-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Company Details</h3>
                        </div>
                        <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Name</dt>
                                <dd><strong>Final Touch Painting</strong></dd>
                                <dt>Industry</dt>
                                <dd>*</dd>
                                <dt>Address</dt>
                                <dd>*</dd>
                                <dt>Phone</dt>
                                <dd>*</dd>
                                <dt>Email</dt>
                                <dd>*</dd>
                                <dt>Tax NO</dt>
                                <dd class="mono">*</dd>
                                <dt>Tax Office</dt>
                                <dd>*</dd>
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
                            <th> <b> Item / Details </b></th>
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
                                    <span class="mono">$ <?php echo number_format($dinerosinComa, 2) ?></span>
                                    <br>
                                    <small class="text-muted">Before Tax</small>
                                </td>
                                <td class="text-right">
                                    <span class="mono">$ <?php echo number_format($bruto, 2)  ?></span>
                                    <br>
                                    <small class="text-muted"><?php echo $row[1] ?> Units</small>
                                </td>
                                <td class="text-right">
                                    <span class="mono">+ $<?php echo number_format($impuesto, 2) ?></span>
                                    <br>
                                    <small class="text-muted">GST 5% </small>
                                </td>
                                <td class="text-right">
                                    <strong class="mono">$<?php echo number_format($total, 2) ?></strong>
                                    <br>
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
                            <th class="text-center rowtotal mono">$ <?php echo number_format($tbruto, 2) ?></th>
                            <th class="text-center rowtotal mono">$ <?php echo number_format($timpuesto, 2) ?></th>
                            <th class="text-center rowtotal mono">$ <?php echo number_format($ttotal, 2) ?></th>
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