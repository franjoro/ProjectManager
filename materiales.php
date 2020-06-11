<?php
session_start();
if(isset($_SESSION['user'])){ 
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
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<style>
.materialesDiv {
    display: none;
}
</style>


<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"  href="dashboard.php">
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
                        <a class="collapse-item " href="proyectos.php">Projects management</a>
                        <a class="collapse-item" href="materiales.php">Manage costs</a>
                        <a class="collapse-item" href="reportes.php">Reports</a>
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
                    <h1 class="h3 mb-2 text-gray-800">
                        Record of costs per project</h1>
                    <form id="CotizacionesForm">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">Choose project</label>
                                <select class="form-control" name="ProjectSelectorCostos" id="ProjectSelectorCostos">
                                    <option disabled selected>Elegir proyecto</option>
                                    <option>Loading</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2 invisible " id="newInput">
                                <label>Nombre de proyecto</label>
                                <input type="text" class="form-control" id="generico" name="generico">
                            </div>
                            <div class="form-group col-md-8 ">
                            </div>
                    </form>
                </div>
                <div class="card shadow mb-4 materialesDiv">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add cost/activities</h6>
                    </div>
                    <div class="card-body">
                        <form id="rows">



                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Proovedor</label>
                                    <select name="provider" id="proovedores" required
                                        class="form-control form-control-sm proovedores">
                                        <option disabled selected>Seleccionar proovedor</option>
                                        <option disabled>Loading...</option>
                                    </select>

                                </div>
                                <div class="form-group col-md-3">
                                    <label>Bill number</label>
                                    <input type="text" required class="form-control form-control-sm" name="bill">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Fecha</label>
                                    <input type="text" required class="form-control form-control-sm" name="date"
                                        id="date">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Forma de pago</label>
                                    <select name="paym" class="form-control form-control-sm">
                                        <option selected disabled>Elegir metodo de pago</option>
                                        <option value="te">TE</option>
                                        <option value="cr">CR</option>
                                        <option value="ot">OT</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="gst" name="gst" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="gst">GST 5%</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="pst" name="pst" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="pst">PST 7%</label>
                                </div>
                            </div>




                    </div>
                    <div class="card-footer">

                        <button class="btn btn-success float-right" type="submit">Insertar</button>

                        </form>
                        <button class="btn btn-success float-left" id="addRowBtn">Agregar nueva fila</i></button>
                    </div>
                </div>






                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Fields to be included in the report</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="tablaMateriales">
                                <h5>Seleecionar proyecto para continuar</h5>
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


    <!-- MODAL -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="js/jquery.mask.js"></script> -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
        integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script src="js/request_handler.js"></script>
    <script src="js/jquery.mask.js"></script>



    <script>
    $(document).ready(function() {
        crearMascara()

        $("#date").datepicker();

    })
    </script>
</body>

</html>
<?php 
} else { 
    header("location:php/destroy.php");
}
?>