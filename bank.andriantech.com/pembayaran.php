<?php
include "database.php";
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

$user = $_SESSION['login'];

//table 1
$query = "SELECT * FROM user WHERE id = '$user'";
$data = $db->prepare($query);
$data->execute();

$user = $data->fetch();
$id = $user['id'];

//table 2
$query2 = "SELECT * FROM saldo WHERE id = '$id'";
$data2 = $db->prepare($query2);
$data2->execute();

$saldo = $data2->fetch();
$uang = $saldo['uang'];



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AndrianTech Bank - Pembayaran</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="sidebar-brand-text mx-3">AndrianTech Bank</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Beranda Keuangan
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-money-bill-wave"></i>
          <span>Keuangan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Keuangan:</h6>
            <a class="collapse-item" href="keuangan.php#isisaldo">Isi Saldo</a>
            <a class="collapse-item" href="keuangan.php#transfer">Transfer</a>
            <a class="collapse-item" href="keuangan.php#booking">Booking</a>
            <a class="collapse-item" href="keuangan.php#minta">Minta</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fab fa-cc-amazon-pay"></i>
          <span>Pembayaran</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Pembayaran:</h6>
            <a class="collapse-item" href="pembayaran.php#pulsa">Pulsa</a>
            <a class="collapse-item" href="pembayaran.php#listrik">Listrik</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="nasabah.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Data Nasabah</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Profil Saya
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="profil.php">
          <i class="fas fa-fw fa-user-alt"></i>
          <span>Profil</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="index.php" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

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
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>



            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $user['nama'];  ?></span>
                <img class="img-profile rounded-circle" src="img/about2.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profil.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
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

          <!-- Content Row -->
          <div class="row mx-auto">

            <!-- Area Chart -->
            <div class="col-xl-10 offset-1">
              <div class="card shadow mb-4 bg-gradient-primary text-white font-weight-bold" id="pulsa">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Isi Pulsa</h6>
                </div>
                <div class="card-body">
                  <h2 class="">Isi Pulsa</h2>
                  <hr class="bg-white">
                  <div class="row">
                    <div class="col">
                      <form method="POST" action="update.php">
                        <div class="form-row">
                          <div class="form-group col-md-3">
                            <label for="inputPassword4">No Hp</label>
                            <input type="tel" class="form-control" id="inputPassword4">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="btn-group col-xl-4 col-sm-4 mb-2">
                            <label class="btn bg-white border-left-info shadow h-100 py-2">
                              <div class="card-body">
                                <div class="font-weight-bold text-info text-center text-uppercase mb-1">
                                  <input type="radio" name="pulsa" id="" value="5000">Rp.5000
                                </div>
                              </div>
                            </label>
                          </div>
                          <div class="btn-group col-xl-4 col-sm-4 mb-2">
                            <label class="btn bg-white border-left-info shadow h-100 py-2">
                              <div class="card-body">
                                <div class="font-weight-bold text-info text-center text-uppercase mb-1">
                                  <input type="radio" name="pulsa" id="" value="10000">Rp.10.000
                                </div>
                              </div>
                            </label>
                          </div>
                          <div class="btn-group col-xl-4 col-sm-4 mb-2">
                            <label class="btn bg-white border-left-info shadow h-100 py-2">
                              <div class="card-body">
                                <div class="font-weight-bold text-info text-center text-uppercase mb-1">
                                  <input type="radio" name="pulsa" id="" value="20000">Rp.20000
                                </div>
                              </div>
                            </label>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="btn-group col-xl-4 col-sm-4 mb-2">
                            <label class="btn bg-white border-left-info shadow h-100 py-2">
                              <div class="card-body">
                                <div class="font-weight-bold text-info text-center text-uppercase mb-1">
                                  <input type="radio" name="pulsa" id="" value="25000">Rp.25.000
                                </div>
                              </div>
                            </label>
                          </div>
                          <div class="btn-group col-xl-4 col-sm-4 mb-2">
                            <label class="btn bg-white border-left-info shadow h-100 py-2">
                              <div class="card-body">
                                <div class="font-weight-bold text-info text-center text-uppercase mb-1">
                                  <input type="radio" name="pulsa" id="" value="50000">Rp.50.000
                                </div>
                              </div>
                            </label>
                          </div>
                          <div class="btn-group col-xl-4 col-sm-4 mb-2">
                            <label class="btn bg-white border-left-info shadow h-100 py-2">
                              <div class="card-body">
                                <div class="font-weight-bold text-info text-center text-uppercase mb-1">
                                  <input type="radio" name="pulsa" id="" value="100000">Rp.100.000
                                </div>
                              </div>
                            </label>
                          </div>
                        </div>
                        <hr class="bg-white">
                        <div class="form-row">
                          <div class="form-group col-sm-4 offset-2">
                            <button type="submit" name="beliPulsa" class="btn btn-info">Beli Pulsa</button>
                          </div>
                          <div class="form-group col-sm-4 offset-2">
                            <button type="reset" class="btn btn-danger">Cancel</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Content Row -->
          <div class="row mx-auto">

            <!-- Area Chart -->
            <div class="col-xl-10 offset-1">
              <div class="card shadow mb-4 bg-gradient-success text-white font-weight-bold" id="listrik">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-success"> Listrik</h6>
                </div>
                <div class="card-body">
                  <h2 class="">Bayar Listrik</h2>
                  <hr class="bg-white">
                  <div class="row">
                    <div class="col">
                      <form method="POST" action="update.php">
                        <div class="form-row">
                          <div class="form-group col-md-3">
                            <label for="inputEmail4">No Meter</label>
                            <input type="number" min="1" class="form-control" id="inputEmail4">
                          </div>
                          <div class="form-group col-md-9">
                            <label for="inputPassword4">Nama Lengkap</label>
                            <input type="text" class="form-control" id="inputPassword4">
                          </div>
                        </div>
                        <div class="form-row">
                          Vouncher Listrik:
                        </div>
                        <div class="form-row">
                          <div class="btn-group col-xl-4 col-sm-4 mb-2">
                            <label class="btn bg-white border-left-info shadow h-100 py-2">
                              <div class="card-body">
                                <div class="font-weight-bold text-info text-center text-uppercase mb-1">
                                  <input type="radio" name="listrik" id="" value="20000">Rp.20.000
                                </div>
                              </div>
                            </label>
                          </div>
                          <div class="btn-group col-xl-4 col-sm-4 mb-2">
                            <label class="btn bg-white border-left-info shadow h-100 py-2">
                              <div class="card-body">
                                <div class="font-weight-bold text-info text-center text-uppercase mb-1">
                                  <input type="radio" name="listrik" id="" value="50000">Rp.50.000
                                </div>
                              </div>
                            </label>
                          </div>
                          <div class="btn-group col-xl-4 col-sm-4 mb-2">
                            <label class="btn bg-white border-left-info shadow h-100 py-2">
                              <div class="card-body">
                                <div class="font-weight-bold text-info text-center text-uppercase mb-1">
                                  <input type="radio" name="listrik" id="" value="100000">Rp.100.000
                                </div>
                              </div>
                            </label>
                          </div>
                        </div>
                        <hr class="bg-white">
                        <div class="form-row">
                          <div class="form-group col-sm-4 offset-2">
                            <button type="submit" name="bayarListrik" class="btn btn-info">Bayar Listrik</button>
                          </div>
                          <div class="form-group col-sm-4 offset-2">
                            <button type="reset" class="btn btn-danger">Cancel</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; andriantech.com 2020</span>
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
            <h5 class="modal-title" id="exampleModalLabel">Anda Ingin keluar?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Tekan "Logout" jika anda ingin keluar sekarang.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>