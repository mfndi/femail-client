<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['key'])){
    header("Location: ../index.php");
}
require_once __DIR__ . '/Controllers/ApiUserController.php';
require_once __DIR__ . '/vendor/autoload.php';
use Carbon\Carbon;
use Controllers\ApiUserController;

$apiController = new ApiUserController();
$fetchMessage = $apiController->listEmailSave($_SESSION['key']);
if($fetchMessage == 401){
    $fetchMessage = [];
}elseif($fetchMessage == 400){
    $fetchMessage = [];
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
                <h1 class="h3 mb-2 text-gray-800">List Email</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
<!--                    <div class="card-header py-3">-->
<!--                        <input type="hidden" id="myInput" value="--><?php //=  $_SESSION['email'];?><!--">-->
<!--                        <button class="btn btn-primary btn-icon-split" id="copyBtn">-->
<!--                            <span class="text">--><?php //=  $_SESSION['email'];?><!--</span>-->
<!--                        </button>-->
<!--                        <button class="btn btn-warning btn-icon-split" onclick="refresh()">-->
<!--                                                            <span class="icon text-white-50">-->
<!--                                                               <i class="fas fa-refresh"></i>-->
<!--                                                            </span>-->
<!--                            <span class="text">REFRESH</span>-->
<!--                        </button>-->
<!--                        <a href="index.php" class="btn btn-info btn-icon-split">-->
<!--                                                            <span class="icon text-white-50">-->
<!--                                                               <i class="fas fa-refresh"></i>-->
<!--                                                            </span>-->
<!--                            <span class="text">BACK</span>-->
<!--                        </a>-->
<!--                    </div>-->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Dtae</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Dtae</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach ($fetchMessage as $key => $data) : ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo  htmlspecialchars($data->email); ?></td>
                                        <td><?php
                                            echo Carbon::parse($data->date)->toDayDateTimeString();
                                            ?></td>
                                        <td>
                                            <a href="list-messages.php?email=<?php echo htmlentities($data->email); ?>" class="btn btn-success">Inbox</a>
                                            <button type="button" onclick="deleteEmail('<?php echo  htmlspecialchars($data->email); ?>')"  class="btn btn-warning">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
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

<!--{{-- modal --}}-->
<div class="modal fade" tabindex="-1" id="modalMessage">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">RESULT</h5>
            </div>
            <div class="modal-body">
                <div class="page-message">

                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!--{{-- end modal --}}-->


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
<script src="js/demo/datatables-demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
<script>
    function deleteEmail(email){
        let key = $('meta[name="key"]').attr('content');
        console.log(key);
        $.ajax({
            url : "delete-email.php",
            method: "POST",
            data : {
                'key': key,
                'email' : email
            },
            success : function(data){
                swal("Hello!", data);
            },error : function (data){
                // console.log(data);
            }
        });

    }
</script>
</html>