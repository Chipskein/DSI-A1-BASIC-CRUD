<?php
    require $_SERVER["DOCUMENT_ROOT"].'/database/database.php';
    class EmprestimoController{
        public static function Livros($where)
        {
            $LivrosDisponiveis=[];
            $db=new Database();
            $con=$db->get();
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
                    $db->close();
                    return $LivrosDisponiveis;
                } 
            }
        }
        public static function LivrosEmprestados($user)
        {   
            $LivrosEmprestados=[];
            $db=new Database();
            $con=$db->get();
            if($con)
            {
                $id=$user;
                $query="select * from LivrosEmprestados join Livros on Livros.id=LivrosEmprestados.livro where LivrosEmprestados.usuario=$id";
                $reqLivrosEmprestados=mysqli_query($con,$query) or mysqli_error($con);         
                if($reqLivrosEmprestados)
                {
                    while ($row = $reqLivrosEmprestados->fetch_array())
                    {
                        array_push($LivrosEmprestados,$row);
                    }
                    $db->close();
                    return $LivrosEmprestados;
                }  
            }
        }
        public static function AlugarLivro($livro,$user)
        {
            $db=new Database();
            $con=$db->get();
            if($con)
            {
               //verifica se qt é 0
                //verifica se já não foi alugado por esse usuario
                $verifyQuery="select qt from Livros where id=$livro and qt!=0 and Livros.id not in (select livro from LivrosEmprestados where usuario=$user);";
                $verify=mysqli_query($con,$verifyQuery) or mysqli_error($con);
                $data=$verify->fetch_array() or NULL;
                if($data)
                {
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
                            header("Location:/assets/view/main.php?suc=Emprestimo+Concluido");
                            exit;
                        }
                    }
                    header("Location:/assets/view/main.php?err=Emprestimo+falhou");
                    exit;
                    
                } 
                else
                {
                    header("Location:/assets/view/main.php?err=Emprestimo+Nao+pode+ser+concluido");
                    exit;
                }
            }
        }
    }
?>