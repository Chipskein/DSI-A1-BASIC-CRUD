<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icons/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Login</title>
</head>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/controllers/UserController.php';
    if(!isset($_SESSION)) session_start();
    if(isset($_SESSION["userid"])) header("Location:/assets/view/main.php");
    if(isset($_POST["email"])&&isset($_POST["password"])&&isset($_POST["submit"]))
    {
        //validar email;
        $email="$_POST[email]";
        $password="$_POST[password]";
        UserController::Login($email,$password);
    }
?>
<body>
    <div align=center>
        <h2>Login</h2>
        <form  method="POST">
            Email:<input type="email" name="email" ><br><br>
            Password:<input type="password" name="password" ><br><br>
            <input type="submit" value="Enviar" name="submit">
        </form><br>
        <a href="/assets/view/register.php">Cadastre-se</a>
    </div>
</body>
</html>