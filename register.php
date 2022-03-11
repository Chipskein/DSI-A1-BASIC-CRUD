<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
</head>
<?php
    if(isset($_POST["email"])&&isset($_POST["password"])&&isset($_POST["nome"])&&isset($_POST["submit"]))
    {
        var_dump($_POST);
    }
?>
<body>
    <div align=center>
        <h2>Cadastro</h2>
        <form action="/register.php" method="POST">
            Nome:<input type="text" name="nome"><br><br>
            Email:<input type="email" name="email"><br><br>
            Password:<input type="password" name="password"><br><br>
            <input type="submit" value="Enviar" name="submit">
        </form>
    </div>
</body>
</html>