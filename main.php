<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="icons/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <title>Main</title>
</head>
<?php
    //arrays
    $LivrosEmprestados=[];
    $LivrosDisponiveis=[];
    $where="";
    if(isset($_POST["search"])&&isset($_POST["searchType"]))
    {
        $searchType=$_POST["searchType"];
        $search=$_POST["search"];
        $where="where $searchType like '%$search%' ";
    }

    if(!isset($_SESSION)) session_start();
    if(isset($_SESSION["userid"])&&isset($_SESSION["email"])&&isset($_SESSION["nome"]))
    {
        $con=mysqli_connect("localhost",'root','','DS1_LIB');
        if($con)
        {
            $query="select * from Livros $where";
            $reqLivros=mysqli_query($con,$query) or mysqli_error($con);         
            if($reqLivros)
            {
                while ($row = $reqLivros->fetch_array())
                {
                    array_push($LivrosDisponiveis,$row);
                }
            }  
            $id=$_SESSION["userid"];
            $query="select * from LivrosEmprestados join Livros on Livros.id=LivrosEmprestados.livro where LivrosEmprestados.usuario=$id";
            $reqLivrosEmprestados=mysqli_query($con,$query) or mysqli_error($con);         
            if($reqLivrosEmprestados)
            {
                while ($row = $reqLivrosEmprestados->fetch_array())
                {
                    array_push($LivrosEmprestados,$row);
                }
            }    
        }
    }
    else
    {
        header("Location:/login.php");
    }

?>
<body>
    <div align="center">
        <h1>Livraria</h1>
        <a href="/logoff.php">LogOff</a>
    </div>
    <br>    
    <div align="center">
        <?php
            echo "<h2>Bem Vindo $_SESSION[nome]!</h2>";
            if(count($LivrosEmprestados)>0)
            {
                    echo "<h2>Seus Emprestimos</h2>";
                    echo "<table>";
                        echo "<tr>";
                            echo "<td>Titulo</td>";
                            echo "<td>Ano</td>";
                            echo "<td>Editora</td>";
                            echo "<td>Autores</td>";
                            echo "<td>Alugado em</td>";
                            echo "<td>Entregar em</td>";
                        echo "</tr>";
                            foreach($LivrosEmprestados as $livro)
                            {
                                
                                $titulo=$livro["titulo"];
                                $ano=$livro["ano"];
                                $editora=$livro["editora"];
                                $autores=$livro["autores"];
                                $qt=$livro["qt"];
                                $dataSaida=$livro["dataSaida"];
                                $dataEntrega=$livro["dataEntrega"];
                                echo "<tr>";
                                    echo "<td>$titulo</td>";
                                    echo "<td>$ano</td>";
                                    echo "<td>$editora</td>";
                                    echo "<td>$autores</td>";
                                    echo "<td>$dataSaida</td>";
                                    echo "<td>$dataEntrega</td>";
                                echo "</tr>";
                            }                
                        
                    echo "</table>"; 
                echo "</div>";
            }
            else
            {
                echo "<h2>Você não tem Emprestimos</h2>";
            }
        ?>
    </div>
    <br>
    <div align="center">
        <h2>Outros Livros</h2>    
        <div align="center">
            <form action="" method="POST">
                <select name="searchType" id="">
                    <option value="titulo">titulo</option>
                    <option value="ano">ano</option>
                </select>
                <input type="text" name="search" id="" placeholder="Pesquisar">
                <input type="submit" value="->">
            </form>
        </div>    
        <table>
            <tr>
                <td>Titulo</td>
                <td>Ano</td>
                <td>Editora</td>
                <td>Autores</td>
                <td>Qt</td>
            </tr>
            <?php
                foreach($LivrosDisponiveis as $livro)
                {
                    $id=$livro["id"];
                    $titulo="$livro[titulo]";
                    $ano=$livro["ano"];
                    $editora="$livro[editora]";
                    $autores="$livro[autores]";
                    $qt=$livro["qt"];
                    echo "<tr>";
                        echo "<td>$titulo</td>";
                        echo "<td>$ano</td>";
                        echo "<td>$editora</td>";
                        echo "<td>$autores</td>";
                        echo "<td>$qt</td>";
                        echo $qt>0 ? "<td><a href=/Emprestimo.php?livro=$id>Alugar</a></td>":"";
                    echo "</tr>";
                }                
            ?>
        </table>    
    </div>
</body>
</html>


