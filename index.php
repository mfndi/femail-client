<?php
// error_reporting(0);
session_start();
require_once __DIR__ . '/dashboard/Controllers/ApiUserController.php';
use Controllers\ApiUserController;

if(isset($_SESSION['key'])){
    header("Location: user/index.php");
}

if(isset($_POST['submit'])){
  $apiController = new ApiUserController();
  $result = $apiController->checkKeyAndGenerate($_POST['key']);
  if($result == 401){
    $notif401 = "Key Not Found";
  }elseif ($result == 400){
      $notif401 = "BANNED!";
  }else{
      $_SESSION['key'] = $_POST['key'];
    $_SESSION['email'] = $result->email;
    header("Location: dashboard/index.php");
  }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DASHBOARD GENERATE EMAIL - CLIENT</title>

    <!-- Custom fonts for this template-->
    <link href="dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="dashboard/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-info">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-2 d-none d-lg-block"></div>
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <?php if(isset($notif401)) : ?>
                                            <div class="alert alert-warning" role="alert">
                                               <?php echo $notif401 ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(isset($notif400)) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $notif400 ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <form  method="post" action="" class="user">
                                        <div class="form-group">
                                            <input type="number" name="key" class="form-control form-control-user" placeholder="Input Key" ">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-unlock-alt"></i> Open
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="https://mail.fecore.my.id" target="_blank">Forgot Key?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="https://mail.fecore.my.id" target="_blank">Create Key!</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="dashboard/vendor/jquery/jquery.min.js"></script>
    <script src="dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="dashboard/js/sb-admin-2.min.js"></script>

</body>

</html>
