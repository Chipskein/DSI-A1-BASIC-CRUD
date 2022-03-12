<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icons/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <title>Login</title>
</head>
<?php
    if(!isset($_SESSION)) session_start();
    if(isset($_SESSION["userid"])) header("Location:/main.php");
    if(isset($_POST["email"])&&isset($_POST["password"])&&isset($_POST["submit"]))
    {

        $con=mysqli_connect("localhost",'root','','DS1_LIB');
        if($con)
        {
            $email="$_POST[email]";
            $password="$_POST[password]";
            $query="select * from Usuario where Usuario.email='$email'";
            $req=mysqli_query($con,$query) or mysqli_error($con);
            if($req)
            {
                $data=$req->fetch_array();
                if(crypt($password,$data["password"])===$data["password"])
                {
                    if(!isset($_SESSION)) session_start();
                    $_SESSION["userid"]=$data["id"];
                    $_SESSION["email"]=$data["email"];
                    $_SESSION["nome"]=$data["nome"];
                    header("Location:/main.php");
                }
                else
                {
                    echo "Um erro ocorreu";
                }

            }
            else
            {
                echo "Um erro ocorreu";
            }

        }
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
        <a href="/register.php">Cadastre-se</a>
    </div>
</body>
</html>