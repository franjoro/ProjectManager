<?php
session_start();
if(isset($_SESSION['code'])){ 
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
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">
        Administración
      </div>

      <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-briefcase"></i>
          <span>Proyectos</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Administrar</h6>
            <a class="collapse-item " href="proyectos.php">Gestión proyectos</a>
            <a class="collapse-item" href="materiales.php">Administrar costos</a>
            <a class="collapse-item" href="reportes.php">Reportes</a>

          </div>
        </div>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="cotizaciones.php">
          <i class="fas fa-file-invoice-dollar"></i>
          <span>Cotizaciones</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">
        Datos previos
      </div>
      <!-- Nav Item - Charts -->
      <li class="nav-item ">
        <a class="nav-link" href="clientes.php">
          <i class="fas fa-user-tie"></i>
          <span>Clientes</span></a>
      </li>

      <li class="nav-item ">
        <a class="nav-link " href="propiedades.php">
          <i class="fas fa-building"></i>
          <span>Propiedades</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item ">
        <a class="nav-link" href="providers.php">
          <i class="fas fa-boxes"></i>
          <span>Proveedores</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" />

      <div class="sidebar-heading">
        Empleados
      </div>

      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-users-cog"></i>
          <span>Colaboradores</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Administrar</h6>
            <a class="collapse-item " href="empleados.php">Empleados</a>
            <a class="collapse-item" href="buttons.html">Horas de trabajo</a>
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
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrador</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60" />
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


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
          <h1 class="h3 mb-4 text-gray-800">Empleados</h1>



          <div class="row">
            <!-- Content Column -->
            <div class="col-lg-5 mb-4">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Agregar nuevo empleado /
                    codigo de empleado: <span style="color: black;">ABC</span>
                  </h6>

                </div>
                <div class="card-body">
                  <form id="empleadosForm">
                    <div class="form-group">
                      <label for="inputAddress">Name *</label>
                      <input type="text" required class="form-control" id="name" name="name" placeholder="Name...">
                    </div>


                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="inputAddress">SIN *</label>
                        <input type="text" required class="form-control" id="sin" name="sin">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="pin">PIN *User and Password *</label>
                        <input type="text" required class="form-control" name="pin" id="pin" maxlength="4">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputAddress">Tel. *</label>
                        <input type="text" required class="form-control" name="tel">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputEmail4">Spouse</label>
                        <input type="text" class="form-control" name="spouse">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputPassword4">Tel. Spouse</label>
                        <input type="text" class="form-control" name="telspouse">
                      </div>
                    </div>



                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputEmail4">Emergency Contact</label>
                        <input type="text" class="form-control" name="emrg">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputPassword4">Tel. Emergency</label>
                        <input type="text" class="form-control" name="telemrg">
                      </div>
                    </div>


                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputEmail4">Term</label>
                        <select class="form-control" name="term">
                          <option disabled selected value="">Choose</option>
                          <option value="1">Salary</option>
                          <option value="0">Hour</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputPassword4">Rate</label>
                        <input type="text" class="form-control" id="rate" name="rate">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputAddress2">Address</label>
                      <textarea class="form-control" placeholder="My place..." name="address"></textarea>

                    </div>

                    <button id="New_button" type="submit" class="btn btn-primary visible">Registrar</button>
                  </form>

                  <button id="loader" class="btn btn-primary invisible" disabled>
                    <span class="spinner-border spinner-border-sm" id="loader" role="status" aria-hidden="true"></span>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-7 mb-4">
              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                    Illustrations
                  </h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <div id="clientTable"></div>
                  </div>
                </div>
              </div>
              <!-- Approach -->
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a class="btn btn-primary" href="login.html">Logout</a>
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/jquery.mask.js"></script>
  <script src="js/demo/datatables-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
  <script src="js/request_handler.js"></script>


  <script>
    $(document).ready(function() {
      tablaEmpleados();
      $("#sin").mask('000-000-000')
      $('#rate').mask('000,000,000,000,000.00', {
        reverse: true
      });
    })
  </script>
</body>

</html>
<?php 
} else { 
    header("location:php/destroy.php");
}
?>