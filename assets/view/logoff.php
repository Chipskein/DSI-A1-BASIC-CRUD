<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/controllers/UserController.php';
    if(!isset($_SESSION)) session_start();
    if(isset($_SESSION["userid"])&&isset($_SESSION["email"])&&isset($_SESSION["nome"]))
    {
        UserController::LogOff();
    }
    else
    {
        header("Location:/assets/view/login.php?war=Not+Logged");
    }
?>