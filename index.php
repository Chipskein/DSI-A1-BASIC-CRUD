<?php
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION["userid"]))
    {
        header("Location:/login.php");
    }
    else
    {
        header("Location:/main.php");
    }
?>