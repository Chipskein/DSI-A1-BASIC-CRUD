<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../icons/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Main</title>
</head>
<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/controllers/EmprestimoController.php';
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
        $LivrosDisponiveis=EmprestimoController::Livros($where);
        $LivrosEmprestados=EmprestimoController::LivrosEmprestados($_SESSION["userid"]);
    }
    else
    {
        header("Location:/assets/view/login.php?war=Nao+Logado");
    }

?>
<body >
    <div class="overlay">
        <div class="header">
            <div class="header-div">
                <img class="logo-header" src="../icons/icon.png" alt="door">
                <a href="/assets/view/logoff.php"><img class="logo-header" src="../icons/logoff.png" alt="door"></a>
            </div>
        </div>
        <div class="main_div">
            <div>
                <?php
                    echo "<h1>Bem Vindo $_SESSION[nome]!</h1>";
                    if(count($LivrosEmprestados)>0)
                    {
                            echo "<h2 class=title>Seus Emprestimos</h2>";
                            echo "<table class=table-emprestados>";
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
                    }
                    else
                    {
                        echo "<h2 class=err>Você não tem Emprestimos</h2>";
                    }
                ?>
            </div>
            <div>
                <h2 class="title">Outros Livros</h2>    
                <div class="div-search">
                    <form class="form-search" method="POST">
                        <select name="searchType" id="searchType">
                            <option value="titulo">titulo</option>
                            <option value="ano">ano</option>
                        </select>
                        <input type="text" name="search" id="search" placeholder="            Pesquisar">
                        <input type="submit" id="search-submit" value="🔎">
                    </form>
                </div>    
                    <?php
                        if(count($LivrosDisponiveis)>0)
                        {
                            echo "<table class=table-disponiveis>";
                            echo "<tr>";
                                echo "<td>Titulo</td>";
                                echo "<td>Ano</td>";
                                echo "<td>Editora</td>";
                                echo "<td>Autores</td>";
                                echo "<td>Qt</td>";
                                echo "<td>📗</td>";
                            echo "</tr>";
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
                                    echo $qt>0 ? "<td><a class=link href=/assets/view/Emprestimo.php?livro=$id>Alugar</a></td>":"<td>❌</td>";
                                echo "</tr>";
                            }    
                            echo "</table><br>";       
                        }    
                        else
                        {
                            echo "<h2 class=err>Nenhum Livro encontrado!</h2>";
                        }
                    ?>
            </div>
        </div>
        <div class="footer">
            
        </div>
    </div>
</body>
</html>


