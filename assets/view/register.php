<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Cadastre-se</title>
</head>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/controllers/UserController.php';
    if(!isset($_SESSION)) session_start();
    if(isset($_SESSION["userid"])) header("Location:/assets/view/main.php");
    if(isset($_POST["email"])&&isset($_POST["password"])&&isset($_POST["nome"])&&isset($_POST["submit"]))
    {
        //validate nome e email
        $name="$_POST[nome]";
        $email="$_POST[email]";
        $password="$_POST[password]";
        UserController::Register($email,$name,$password);
    }
?>
<body>
    <div class="overlay">
        <div class="root">
            <div class="div-input">
                <div class="div-logo">
                    <img class="logo" src="../icons/icon.png" alt="">
                </div>
                <h3>Por Favor Registre-se</h3>
                <form class="form" method="POST">
                    <label>Nome:<input type="text" name="nome" class="form-input"></label>
                    <label>Email:<input type="email" name="email" class="form-input"></label>
                    <label>Password:<input type="password" name="password" class="form-input"></label>
                    <label><input type="submit" value="Registrar-se" name="submit" class="submit-buttom"></label>
                </form>
            </div>
        </div>
    </div>
</body>
</html>