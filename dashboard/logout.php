<?php
session_start();
if(!isset($_SESSION['key'])){
    header("Location: ../index.php");
}

$_SESSION = [];
session_destroy();
session_unset();

header("Location: ../index.php");
exit();


?>