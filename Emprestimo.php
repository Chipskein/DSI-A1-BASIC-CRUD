<?php
    if(!isset($_SESSION)) session_start();
    if(isset($_GET["livro"])&&isset($_SESSION["userid"]))
    {
        $con=mysqli_connect("localhost",'root','','DS1_LIB');
        if($con)
        {
            $livro=$_GET["livro"];
            $user=$_SESSION["userid"];
            
            //verifica se qt é 0
            //verifica se já não foi alugado por esse usuario
            $verifyQuery="select qt from Livros where id=$livro and qt!=0 and Livros.id not in (select livro from LivrosEmprestados where usuario=$user);";
            $verify=mysqli_query($con,$verifyQuery) or mysqli_error($con);
            $data=$verify->fetch_array() or NULL;
            if($data)
            {
                $oldqt=$data["qt"];
                $qt=$data["qt"]-1;
                //Inserir na tabela LivrosEmprestimos
                $insertInQuery="insert into LivrosEmprestados(livro,usuario,dataEntrega) VALUES($livro,$user,CURRENT_TIMESTAMP)";
                $insertIn=mysqli_query($con,$insertInQuery);
                if($insertIn)
                {           
                    $updateQuery="UPDATE `Livros` SET qt='$qt' WHERE `Livros`.id=$livro;";
                    $update=mysqli_query($con,$updateQuery) or mysqli_error($con); 
                    if($update)
                    {
                        header("Location:/main.php");
                        exit;
                    }
                }
                
            }
            header("Location:/main.php");
            exit;
        }
    }
?>