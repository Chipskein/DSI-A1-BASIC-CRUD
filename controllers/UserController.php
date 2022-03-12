<?php
    require $_SERVER["DOCUMENT_ROOT"].'/database/database.php';
    class UserController{
        public static function Login($email,$password)
        {
            $db=new Database();
            $con=$db->get();
            if($con)
            {
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
                        $db->close();
                        header("Location:/assets/view/main.php");
                    }
                    else
                    {
                        $db->close();
                        header("Location:/assets/view/login.php?err=Login+Invalido");
                    }
        
                }
                else
                {
                    header("Location:/assets/view/login.php?err=Database+Connection+Failed");
                }
        
            }
        }
        public static function LogOff()
        {
            unset($_SESSION["userid"]);
            unset($_SESSION["email"]);
            unset($_SESSION["nome"]);
            session_destroy();
            header("Location:/assets/view/login.php?suc=Deslogado+com+Sucesso");
        }
        public static function Register($email,$name,$password)
        {
            $db=new Database();
            $con=$db->get();
            if($con)
            {
                $salt="Cf1f11ePArKlBJomM0F6aJ";
                $custo="08";
                $hashpassword=crypt($password,'$2a$' . $custo . '$' . $salt . '$');
                $query="insert into Usuario(email,nome,password) values('$email','$name','$hashpassword')";
                $req=mysqli_query($con,$query) or mysqli_error($con);
                if($req)
                {
                    $db->close();
                    header("Location:/assets/view/login.php?suc=Usuario+Registrado");   
                }
                else
                {
                    header("Location:/assets/view/login.php?err=Usuario+Nao+Registrado");
                    $db->close();
                }

            }
            else
            {
                header("Location:/assets/view/register.php?err=Database+Connection+Failed");
            }
        }
    }
   



?>