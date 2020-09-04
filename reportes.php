<?php session_start();
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
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        Hours Worked
                                    </h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 mb-4">
                                            <label>Filter by</label> <br>
                                            <button class="btn btn-success" id="filter1">Empleoyees</button>
                                            <button class="btn btn-info" id="filter2">All Projects</button>
                                        </div>
                                        <div class="col-xl-6 col-md-6 mb-4" id="selectores">
                                            <label>Filter by Date</label>
                                            <div id="reportrange"
                                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                                <i class="fa fa-calendar"></i>&nbsp;
                                                <span></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                            <div id="selector">
                                                <hr>
                                                <label>Select Project</label>
                                                <select id="proj" class="form-control">
                                                    <option value="All">All</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="div_1">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        By empleoyess table
                                    </h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="order_data" class="display responsive nowrap" style="width:100%">
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-none" id="div_2">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        By projects table
                                    </h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="order_data2" class="display responsive nowrap" style="width:100%">
                                        </table>
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
                        <span>Copyright &copy; Your Website 2019</span>
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
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
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
    <!-- <script src="js/request_handler.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js">
    </script>
    <script async type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.21/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/datatables.min.js">
    </script>
    <script async src="js/REmpleados.js"></script>
</body>

</html>
<?php
} else {
    header("location:php/destroy.php");
}
?>