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
if(isset($_GET['email'])){
    $rep = str_replace(" ", "+", $_GET['email']);
    $fetchMessage = $apiController->listMessages($_SESSION['key'],$rep);
        if(isset($fetchMessage->message)){
            header("Location: index.php");
        }
    $email = htmlspecialchars($_GET['email']);
}else{
    $fetchMessage = $apiController->listMessages($_SESSION['key'], $_SESSION['email']);
    $email = htmlspecialchars($_SESSION['email']);
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
                <h1 class="h3 mb-2 text-gray-800">Inbox</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <input type="hidden" id="myInput" value="<?=  $_SESSION['email'];?>">
                        <button class="btn btn-outline btn-success" id="copyBtn">
                            <span class="text"><?=  $email;?></span>
                        </button>
                        <button class="btn btn-warning btn-icon-split" onclick="refresh()">
                            <span class="text">REFRESH</span>
                        </button>
                        <?php if(!isset($_GET['email'])) : ?>
                        <button class="btn btn-info btn-icon-split" onclick="save()">
                            <span class="text">SAVE</span>
                        </button>
                        <?php endif; ?>
<!--                        <a href="index.php" class="btn btn-info btn-icon-split">-->
<!--                            <span class="text">BACK</span>-->
<!--                        </a>-->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>From</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Show</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>From</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Show</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach ($fetchMessage as $key => $data) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo  htmlspecialchars($data->from); ?></td>
                                    <td><?php echo  htmlspecialchars($data->subject); ?></td>
                                    <td><?php
                                           echo Carbon::parse($data->date)->toDayDateTimeString();
                                        ?></td>
                                    <td><button type="button" onclick="show('<?php echo $data->id; ?>')" class="btn btn-success">Show</button></td>
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
    function show(id)
    {
        let key = $('meta[name="key"]').attr('content');
        $.ajax({
            url: 'message.php',
            method: "POST",
            data : {
                'key': key,
                'id' : id
            },
                success : function(data){
                    $('#modalMessage').modal('show');
                    $('.page-message').html(data);
                },
            error: function (data){
                console.log(data)
            }
        })

    }

    function  refresh()
    {
       window.location.reload();
    }

    function  save(){
        let key = $('meta[name="key"]').attr('content');
        let email = $('#myInput').val();

        $.ajax({
            url: "save-email.php",
            method: "POST",
            data : {
                'key': key,
                'email' : email
            },
            success: function (data){
                swal("Hello!", data);
            },error: function (data){
                console.log(data)
            }
        })
    }

    $(document).ready(function() {
        // Fungsi untuk menyalin teks ke clipboard
        function copyToClipboard(text) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(text).select();
            document.execCommand("copy");
            $temp.remove();
        }
        $("#copyBtn").click(function() {
            var textToCopy = $("#myInput").val(); // Ambil teks dari input
            copyToClipboard(textToCopy); // Salin teks ke clipboard
            alert("Success Copy!"); // Tampilkan pesan sukses
        });
    });
</script>
</html>
