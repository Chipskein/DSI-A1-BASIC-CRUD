<?php
    if(!isset($_SESSION)) session_start();
    if(isset($_SESSION["userid"])&&isset($_SESSION["email"])&&isset($_SESSION["nome"]))
    {
        unset($_SESSION["userid"]);
        unset($_SESSION["email"]);
        unset($_SESSION["nome"]);
        session_destroy();
        echo "Usuario Deslogado";
        header("Location:/login.php");

    }
    else
    {
        header("Location:/login.php");
    }
?>