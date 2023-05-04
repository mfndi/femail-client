<?php
error_reporting(0);
session_start();
require_once __DIR__ . '/Controllers/ApiUserController.php';
use Controllers\ApiUserController;
$apiController = new ApiUserController();

if(!isset($_SESSION['key'])){
    header("Location: ../index.php");
}


if(isset($_POST['generate'])){
    
    $result = $apiController->checkKeyAndGenerate($_SESSION['key']);
    $_SESSION['email'] = $result->email;
    
}

if(isset($_POST['inbox'])){
    $_SESSION['email'] = $_POST['email'];
    header("Location: list-messages.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once __DIR__ . '/layouts/head.php'; ?>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
        <?php require_once __DIR__ . '/layouts/sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php require_once __DIR__ . '/layouts/topbar.php'; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
<!--                    <div class="col-xl-3 col-md-6 mb-4">-->
<!--                        <div class="card border-left-primary shadow h-100 py-2">-->
<!--                            <div class="card-body">-->
<!--                                <div class="row no-gutters align-items-center">-->
<!--                                    <div class="col mr-2">-->
<!--                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">-->
<!--                                            Earnings (Monthly)</div>-->
<!--                                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>-->
<!--                                    </div>-->
<!--                                    <div class="col-auto">-->
<!--                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

                    <!-- Earnings (Monthly) Card Example -->
<!--                    <div class="col-xl-3 col-md-6 mb-4">-->
<!--                        <div class="card border-left-success shadow h-100 py-2">-->
<!--                            <div class="card-body">-->
<!--                                <div class="row no-gutters align-items-center">-->
<!--                                    <div class="col mr-2">-->
<!--                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">-->
<!--                                            Earnings (Annual)</div>-->
<!--                                        <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>-->
<!--                                    </div>-->
<!--                                    <div class="col-auto">-->
<!--                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

                    <!-- Earnings (Monthly) Card Example -->
<!--                    <div class="col-xl-3 col-md-6 mb-4">-->
<!--                        <div class="card border-left-info shadow h-100 py-2">-->
<!--                            <div class="card-body">-->
<!--                                <div class="row no-gutters align-items-center">-->
<!--                                    <div class="col mr-2">-->
<!--                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks-->
<!--                                        </div>-->
<!--                                        <div class="row no-gutters align-items-center">-->
<!--                                            <div class="col-auto">-->
<!--                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>-->
<!--                                            </div>-->
<!--                                            <div class="col">-->
<!--                                                <div class="progress progress-sm mr-2">-->
<!--                                                    <div class="progress-bar bg-info" role="progressbar"-->
<!--                                                         style="width: 50%" aria-valuenow="50" aria-valuemin="0"-->
<!--                                                         aria-valuemax="100"></div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-auto">-->
<!--                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

                    <!-- Pending Requests Card Example -->
<!--                    <div class="col-xl-3 col-md-6 mb-4">-->
<!--                        <div class="card border-left-warning shadow h-100 py-2">-->
<!--                            <div class="card-body">-->
<!--                                <div class="row no-gutters align-items-center">-->
<!--                                    <div class="col mr-2">-->
<!--                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">-->
<!--                                            Pending Requests</div>-->
<!--                                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>-->
<!--                                    </div>-->
<!--                                    <div class="col-auto">-->
<!--                                        <i class="fas fa-comments fa-2x text-gray-300"></i>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>

                <!-- Content Row -->

                <div class="row">
                    <div class="col-lg-3 d-none d-lg-block"></div>
                    <div class="col-lg-5">
                        <div class="p-5">
                            <div class="text-center">
                            </div>
                            <form class="user" method="post" action="">
                                <div class="form-group">
                                   <input type="email" class="form-control form-control-user" name="email" style="font-size: 20px; text-align: center;" value="<?php echo $_SESSION['email'] ?>" readonly>
                                </div>
                                <button type="submit" name="inbox" class="btn btn-primary btn-user btn-block">
                                    <i class="fa fa-inbox"></i> GO
                                </button>

                            </form>
                            <hr>
                            <form class="user" method="post" action="">
                                <button type="submit" name="generate" class="btn btn-google btn-user btn-block">
                                    <i class="fa fa-spinner "></i> GENERATE!
                                </button>
                            </form>
                            <hr>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $apiController->news()->title ?></h6>
                                </div>
                                <div class="card-body">
                                    <p><?php echo $apiController->news()->note ?></p>
                                    <a target="_blank" rel="nofollow" href="https://github.com/mfndi/femail-client">GO TO GITHUB REPO →</a>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
<!--        <footer class="sticky-footer bg-white">-->
<!--            <div class="container my-auto">-->
<!--                <div class="copyright text-center my-auto">-->
<!--                    <span>Copyright &copy; Your Website 2021</span>-->
<!--                </div>-->
<!--            </div>-->
<!--        </footer>-->
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
<?php require_once __DIR__ . "/layouts/modalLogout.php"; ?>

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
