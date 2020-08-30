<?php
session_start();
if (isset($_SESSION['user'])) {
    include("./php/conexion.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Project Manager</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-home"></i>
                </div>
                <div class="sidebar-brand-text mx-1">Control Cost Center</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0" />
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider" />
            <!-- Heading -->
            <div class="sidebar-heading">
                Administration
            </div>
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-briefcase"></i>
                    <span>Projects</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Administration</h6>
                        <a class="collapse-item " href="proyectos.php">Project management</a>
                        <a class="collapse-item" href="materiales.php">Purchase management</a>
                        <a class="collapse-item" href="reportesP.php">Projects/Provider Reports</a>
                    </div>
                </div>
            </li>
            <li class="nav-item  ">
                <a class="nav-link" href="cotizaciones.php">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Activities quote</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">
                Previous Data
            </div>
            <!-- Nav Item - Charts -->
            <li class="nav-item ">
                <a class="nav-link" href="clientes.php">
                    <i class="fas fa-user-tie"></i>
                    <span>Clients</span></a>
            </li>

            <li class="nav-item ">
                <a class="nav-link " href="propiedades.php">
                    <i class="fas fa-building"></i>
                    <span>Properties</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item ">
                <a class="nav-link" href="providers.php">
                    <i class="fas fa-boxes"></i>
                    <span>Providers</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />
            <div class="sidebar-heading">
                Employees
            </div>
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users-cog"></i>
                    <span>Employees Management</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Administrar</h6>
                        <a class="collapse-item " href="empleados.php">Employees</a>
                        <a class="collapse-item" href="labor.php">Work time</a>
                        <a class="collapse-item" href="reportes.php">Employees Reports</a>
                    </div>
                </div>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-chevron-circle-down"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">


                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Contactar con el programador
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">


                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Contactar con el programador
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Working hours</h1>
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        Employees table
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div id="clientTable"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        Working hours
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div id="reportrange"
                                        style="background: #fff; cursor: pointer; padding: 5px 10px; width: 100%"
                                        class="d-none">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                        <hr>
                                    </div>
                                    <div class="table-responsive">
                                        <div id="labortable">
                                            <p>Select employee to see hours worked
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <!-- <span>Copyright &copy; Your Website 2019</span> -->
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="php/destroy.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->


    <!-- Page level custom scripts -->

    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
        integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>

    <!-- all my things -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script async type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js">
    </script>
    <script async type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js">
    </script>
    <script async type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.21/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/datatables.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
    const start = moment().subtract(29, 'days');
    const end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                'month')]
        }
    }, cb);


    cb(start, end);


    const getTableEm = () => {
        $.ajax({
            url: `php/empleados/tablatolabor.php?entrada=${start.format('MM/DD/YYYY')}&salida=${end.format('MM/DD/YYYY')}`
        }).done(data => {
            $("#clientTable").html(data)
            $("#dataTable").DataTable();
        })
    }
    let nameGlobal = "";
    let idGlobal = "";
    const showlaborAndS = (id, name, entrada, salida) => {
        nameGlobal = name;
        idGlobal = id;
        showlabor(id, name, entrada, salida);
    }

    $("#reportrange").on("apply.daterangepicker", function(t, a) {
        showlabor(idGlobal,nameGlobal,a.startDate.format('MM/DD/YYYY'), a.endDate.format('MM/DD/YYYY'))
    });
    const showlabor = (id, name, entrada, salida) => {
        $.ajax({
            url: `php/empleados/labor.php?id=${id}&name=${name}&entrada=${entrada}&salida=${salida}`
        }).done(data => {
            $("#labortable").html(data)
            $("#reportrange").removeClass("d-none")
            $("#myTable").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ]
            });
        })
    }

    const calculardiferencia = (hora_inicio, hora_final) => {
        // Expresión regular para comprobar formato
        var formatohora = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
        // Si algún valor no tiene formato correcto sale
        if (!(hora_inicio.match(formatohora) && hora_final.match(formatohora))) {
            return;
        }
        // Calcula los minutos de cada hora
        var minutos_inicio = hora_inicio
            .split(":")
            .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
        var minutos_final = hora_final
            .split(":")
            .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
        // Si la hora final es anterior a la hora inicial sale
        if (minutos_final < minutos_inicio) return;
        // Diferencia de minutos
        var diferencia = minutos_final - minutos_inicio;
        // Cálculo de horas y minutos de la diferencia
        var horas = Math.floor(diferencia / 60);
        var minutos = diferencia % 60;
        const total = horas + ":" + (minutos < 10 ? "0" : "") + minutos;
        return total;
    };

    const getTodayDate = () => {
        let date = new Date();
        let m = ("0" + (date.getMonth() + 1)).slice(-2);
        let d = date.getDay();
        let y = date.getFullYear();
        return `${d}/${m}/${y}`;
    };


    const error_empty = () => {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Fill all data",
        });
    };

    const PutTimePicker = (start, end) => {
        $("#entrada").timepicker({
            timeFormat: "HH:mm",
            interval: 30,
            // minTime: "6:00am",
            // maxTime: "6:00pm",
            startTime: "6:00am",
            dynamic: false,
            dropdown: false,
            defaultTime: start || "now",
            // scrollbar: true,
        });

        $("#salida").timepicker({
            timeFormat: "HH:mm",
            interval: 30,
            // minTime: "6:00am",
            // maxTime: "6:00pm",
            startTime: "6:00am",
            dynamic: false,
            dropdown: false,
            defaultTime: end || "now",
            // scrollbar: true,
        });
    };

    const AddHoras = async id => {
        const {
            value: formValues
        } = await Swal.fire({
            title: 'Add Work Hours',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            html: `
            <div class="form-group" id="Proyectoos" >
                <select id='proyecto' class='form-control' >
                    <option disabled selected>Select Project</option>
                    <option disabled >Loading...</option>
                </select>
            </div>
            <div class="form-group" id="dateDiv" >    
                <input id="date" class="form-control" placeholder='Date' >
            </div>
            <div class="form-group">    
                <input id="entrada" class="form-control" placeholder='Entry hour' >
            </div>
            <div class="form-group">
                <input id="salida" class="form-control" placeholder='Exit hour' >
            </div> `,
            focusConfirm: false,
            onOpen: () => {
                $("#date").datepicker();
                PutTimePicker();
                $.ajax({
                    url: "empleados/php/ObtenerProyecto2.php",
                }).done((data) => {
                    banderaDown = true;
                    $("#proyecto").html(data);
                });
            },
            preConfirm: () => {
                if (validate.isEmpty($("#entrada").val()) || validate.isEmpty($("#salida").val()) ||
                    validate.isEmpty($("#date").val()) || validate.isEmpty($("#proyecto")
                        .children("option:selected")
                        .val())) {
                    error_empty();
                } else {
                    return [
                        document.getElementById('entrada').value,
                        document.getElementById('salida').value,
                        document.getElementById('date').value,
                        $("#proyecto")
                        .children("option:selected")
                        .val()
                    ]
                }

            }
        })

        if (formValues) {
            const data = formValues
            const PromiseEntrada = new Promise((resolve, reject) => {
                $.ajax({
                    type: "POST",
                    url: "empleados/php/insertarEntrada.php?date=" + data[2] +
                        "&admin=true&user=" + id,
                    data: {
                        entrada: data[0],
                        selectedProject: data[3]
                    },
                }).done((data) => {
                    resolve(data)
                });
            })
            Promise.all([PromiseEntrada]).then(
                (code) => {
                    const horas = calculardiferencia(data[0], data[1]);
                    $.ajax({
                        type: "POST",
                        url: "empleados/php/insertarSalida.php?date=" + data[2],
                        data: {
                            code: code[0],
                            salida: data[1],
                            horas: horas
                        },
                    }).done((data) => {
                        Swal.fire("OK", "Work Done", "success");
                         showlabor(id,nameGlobal,start.format('MM/DD/YYYY'),end.format('MM/DD/YYYY'))
                    });
                }
            );
        }
    }

    const deleteLabor = (id, empleado) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this! ID ctz: " + id,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.value) {
                const p1 = new Promise((res, rej) => {
                    $.ajax({
                        url: `php/empleados/eliminarLabor.php?id=${id}`,
                    }).done(() => {
                        res();
                    });
                });
                Promise.all([p1]).then(
                    Swal.fire("Deleted!", "Your file has been deleted.", "success").then(
                        () => {
                            showlabor(empleado,nameGlobal,start.format('MM/DD/YYYY'),end.format('MM/DD/YYYY'))
                        }
                    )
                );
            }
        });
    };
    const NotEditable = () => {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "You cannot edit this cell",
        });
    };

    // ACTUALIZAR 
    $("#labortable").on("click", "tbody td", async function() {
        const toSend = $(this).data();
        if (toSend.tabla === "delete") {
            return deleteLabor(toSend.code, toSend.empleado);
        }
        if (toSend.tabla === "NotEditable") {
            return NotEditable();
        }
        const {
            value: formValues
        } = await Swal.fire({
            title: 'Edit Work Hours',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            html: `
            <div class="form-group" id="dateDiv" >  
                <label for="entrada">Entry</label>  
                <input id="entrada" class="form-control" value="10" >
            </div>
            <div class="form-group">    
                <label for="salida">Exit</label>
                <input id="salida" class="form-control" value="" >
            </div> `,
            focusConfirm: false,
            onOpen: () => {
                PutTimePicker(toSend.start, toSend.end);
            },
            preConfirm: () => {
                if (validate.isEmpty($("#entrada").val()) || validate.isEmpty($("#salida")
                        .val())) {
                    error_empty();
                } else {
                    return [
                        document.getElementById('entrada').value,
                        document.getElementById('salida').value,
                        toSend.code,
                        toSend.empleado
                    ]
                }

            }
        })

        if (formValues) {
            const data = formValues
            const PromiseEntrada = new Promise((resolve, reject) => {
                const horas = calculardiferencia(data[0], data[1])
                $.ajax({
                    type: "POST",
                    url: "php/empleados/editHoras.php?",
                    data: {
                        entrada: data[0],
                        salida: data[1],
                        horas,
                        code: data[2]
                    },
                }).done((data) => {
                    console.log(data);
                    resolve(data)
                });
            })

            Promise.all([PromiseEntrada])
                .then(
                    (code) => {
                        Swal.fire("OK", "Work Done", "success");
                        showlabor(data[3],nameGlobal,start.format('MM/DD/YYYY'),end.format('MM/DD/YYYY'))
                    }
                );
        }

    });



    $(document).ready(function() {
        getTableEm()
    })
    </script>


</body>

</html>
<?php
} else {
    header("location:php/destroy.php");
}
?>