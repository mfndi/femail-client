<?php
session_start();
if(!isset($_SESSION['key'])){
    header("Location: ../index.php");
}
require_once __DIR__ . '/Controllers/ApiUserController.php';
require_once __DIR__ . '/vendor/autoload.php';
use Carbon\Carbon;
use Controllers\ApiUserController;

if(isset($_POST['key']) && !empty($_POST['key'])){
    $apiController = new ApiUserController();
    $message = $apiController->showMessage($_POST['key'], $_POST['id']);
    echo $message;
}
