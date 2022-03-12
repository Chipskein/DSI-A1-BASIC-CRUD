<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/controllers/EmprestimoController.php';
    if(!isset($_SESSION)) session_start();
    if(isset($_GET["livro"])&&isset($_SESSION["userid"]))
    {
        $livro=$_GET["livro"];
        $user=$_SESSION["userid"];
        EmprestimoController::AlugarLivro($livro,$user);
    }
?>